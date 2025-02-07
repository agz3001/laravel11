<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // api用
    public function apiIndex(){
        return view("api.index");
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with("comments")->orderBy("created_at", "desc")->get();
        // $posts = Post::all();
        return view("posts.index", ["posts" => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("posts.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "title" => "required"|"max:20",
            "content" => "required"|"max:20",
        ]);
        $post = new Post();
        $form = $request->all();
        $post->fill($form)->save();
        return redirect()->route("posts.show", ["post" => $post]);
    }

    /**
     * Display the specified resource.
     */
    public function show($post_id)
    {
        $post = Post::findOrFail($post_id);
        return view("posts.show", ["post" => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($post_id)
    {
        $post = Post::findOrFail($post_id);
        return view("posts.edit", ["post" => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $post_id)
    {
        $request->validate([
            "title" => "required"|"max:20",
            "content" => "required"|"max:20",
        ]);
        $post = Post::findOrFail($post_id);
        $form = $request->all();
        $post->fill($form)->save();
        return redirect()->route("posts.show", ["post" => $post]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($post_id)
    {
        $post = Post::findOrFail($post_id);
        $post->comments()->delete();
        $post->delete();
        return redirect()->route("top", compact("post"));
    }

    public function search(Request $request){
        // クエリ生成
        $query = Post::query();
        // キーワード受け取り
        $searchWord = $request->input('searchWord');
        if ($searchWord) {
            // $query->where('title', 'like', '%'.$searchWord.'%')->orWhere("content", "like", "%".$searchWord."%");
            $query->where(function($q) use ($searchWord){
                $q->where('title', 'like', '%'.$searchWord.'%')
                ->orWhere("content", "like", "%".$searchWord."%");
            });
        }
        $data = $query->get();
        return view('posts.search', compact("data"));
    }
}
