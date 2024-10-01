<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Like;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // Display a listing of the posts
    public function index()
    {
        // Retrieve posts with likes and determine if the current user liked each post
        $userId = auth()->id();
        $posts = Post::with('likes')->get()->map(function ($post) use ($userId) {
            return [
                'id' => $post->id,
                'title' => $post->title,
                'content' => $post->content,
                'isLiked' => $post->likes()->where('user_id', $userId)->exists(),
                'likesCount' => $post->likes->count(),
            ];
        });

        return inertia('Posts/Index', compact('posts'));
    }

    // Show the form for creating a new post
    public function create()
    {
        return view('posts.create');
    }

    // Store a newly created post in the database
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        Post::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('posts.index')->with('success', 'Post created successfully!');
    }

    // Display the specified post
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    // Show the form for editing the specified post
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    // Update the specified post in the database
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        $post->update($request->only(['title', 'content']));

        return redirect()->route('posts.index')->with('success', 'Post updated successfully!');
    }

    // Remove the specified post from the database
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully!');
    }

    // Like a post
    public function like(Request $request, $postId)
    {
        $like = Like::firstOrCreate([
            'user_id' => $request->user()->id,
            'post_id' => $postId,
        ]);

        return response()->json(['success' => true]);
    }

    // Unlike a post
    public function unlike(Request $request, $postId)
    {
        $like = Like::where('user_id', $request->user()->id)
                    ->where('post_id', $postId);

        if ($like->exists()) {
            $like->delete();
        }

        return response()->json(['success' => true]);
    }
}
