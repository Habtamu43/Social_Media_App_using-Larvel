<?php

namespace App\Http\Controllers;

use App\Models\Comment; // Import the Comment model
use Illuminate\Http\Request;

class CommentController extends Controller
{
    // Display a listing of comments
    public function index()
    {
        $comments = Comment::all();
        return view('comments.index', compact('comments'));
    }

    // Show the form for creating a new comment
    public function create()
    {
        return view('comments.create');
    }

    // Store a newly created comment in the database
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required',
        ]);

        Comment::create([
            'content' => $request->content,
            // Add any other fields as necessary
        ]);

        return redirect()->route('comments.index')->with('success', 'Comment created successfully!');
    }

    // Display the specified comment
    public function show(Comment $comment)
    {
        return view('comments.show', compact('comment'));
    }

    // Show the form for editing the specified comment
    public function edit(Comment $comment)
    {
        return view('comments.edit', compact('comment'));
    }

    // Update the specified comment in the database
    public function update(Request $request, Comment $comment)
    {
        $request->validate([
            'content' => 'required',
        ]);

        $comment->update($request->only(['content']));

        return redirect()->route('comments.index')->with('success', 'Comment updated successfully!');
    }

    // Remove the specified comment from the database
    public function destroy(Comment $comment)
    {
        $comment->delete();

        return redirect()->route('comments.index')->with('success', 'Comment deleted successfully!');
    }
}
