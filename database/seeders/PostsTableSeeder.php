<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Comment;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Post::factory()
        ->count(5)
        ->create()
        ->each(function ($post){
            $comments = Comment::factory(2)->make();
            $post->comments()->saveMany($comments);
        });
    }
}
