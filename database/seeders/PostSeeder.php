<?php

namespace Database\Seeders;

use App\Models\Post; // Make sure to include the Post model
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create sample posts
        Post::create([
            'user_id' => 1, // Assuming a user with ID 1 exists
            'title' => 'First Post',
            'content' => 'This is the content of the first post.',
        ]);

        Post::create([
            'user_id' => 1,
            'title' => 'Second Post',
            'content' => 'This is the content of the second post.',
        ]);

        Post::create([
            'user_id' => 1,
            'title' => 'Third Post',
            'content' => 'This is the content of the third post.',
        ]);
    }
}

