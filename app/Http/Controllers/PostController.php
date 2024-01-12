<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts=Post::with('category')->orderBy('id', 'desc')->paginate(5);
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias=Category::select('id', 'nombre')->orderBy('nombre')->get();
        return view('posts.nuevo', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo'=>['required', 'string', 'min:3', 'unique:posts,titulo'],
            'contenido'=>['required', 'string', 'min:10'],
            'publicado'=>['nullable'],
            'category_id'=>['required', 'exists:categories,id'],
            'imagen'=>['nullable', 'image', 'max:2048'],
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('posts.detalle', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
