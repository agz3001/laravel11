<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// 追加
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::get()->toJson(JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
        return response($posts, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $post = new Post();
        $post->title = $request->title;
        $post->content = $request->content;
        $post->save();
        return response()->json(["message" => "created successfully"], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (Post::where("id", $id)->exists()) {
            $post = Post::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($post, 200);
        } else {
            return response()->json(["message" => "Not found"], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (Post::where('id', $id)->exists()) {
            $post = Post::find($id);
            $post->title = is_null($request->title) ? $post->title : $request->title;
            $post->content = is_null($request->content) ? $post->content : $request->content;
            $post->save();
            return response()->json(["message" => "updated successfully"], 200);
        } else {
            return response()->json(["message" => "Not found"], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Post::where('id', $id)->exists()) {
            $post = Post::find($id);
            $post->delete();
            return response()->json(["message" => "deleted successfully"], 202);
        } else {
            return response()->json(["message" => "Not found"], 404);
        }
    }
}
