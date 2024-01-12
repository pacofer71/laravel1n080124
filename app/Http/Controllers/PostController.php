<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('category')->orderBy('id', 'desc')->paginate(5);
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Category::rellenarSelectsCategorias();
        return view('posts.nuevo', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => ['required', 'string', 'min:3', 'unique:posts,titulo'],
            'contenido' => ['required', 'string', 'min:10'],
            'publicado' => ['nullable'],
            'category_id' => ['required', 'exists:categories,id'],
            'imagen' => ['nullable', 'image', 'max:2048'],
        ]);
        //Se llego aquí es por que las validaciones estan OK, vamos a guardar el registro
        //1.- Guardamos la imagen en storage/app/public/posts
        $ruta = ($request->imagen) ? $request->imagen->store('posts') : "posts/noimage.jpg";
        Post::create([
            'titulo' => ucfirst($request->titulo),
            'contenido' => ucfirst($request->contenido),
            'publicado' => ($request->publicado) ? "SI" : "NO",
            'category_id' => $request->category_id,
            'imagen' => $ruta,
        ]);
        return redirect()->route('posts.index')->with('info', 'Post Guardado.');
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
        $categorias = Category::rellenarSelectsCategorias();
        return view('posts.actualizar', compact('post', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'titulo' => ['required', 'string', 'min:3', 'unique:posts,titulo,' . $post->id],
            'contenido' => ['required', 'string', 'min:10'],
            'publicado' => ['nullable'],
            'category_id' => ['required', 'exists:categories,id'],
            'imagen' => ['nullable', 'image', 'max:2048'],
        ]);
        //Se llego aquí es por que las validaciones estan OK, vamos a editar el registro
        $ruta = $post->imagen;
        if ($request->imagen) {
            //hemos subido una imagen nueva borraremos laanterior salvo que sea la imagen por defecto
            if (basename($post->imagen) != 'noimage.jpg') {
                Storage::delete($post->imagen);
            }
            $ruta = $request->imagen->store('posts');
        }
        $post->update([
            'titulo' => ucfirst($request->titulo),
            'contenido' => ucfirst($request->contenido),
            'publicado' => ($request->publicado) ? "SI" : "NO",
            'category_id' => $request->category_id,
            'imagen' => $ruta,
        ]);
        return redirect()->route('posts.index')->with('info', 'Post Actualizado.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if (basename($post->imagen) != 'noimage.jpg') {
            Storage::delete($post->imagen);
        }
        $post->delete();
        return redirect()->route('posts.index')->with('info', 'Post Borrado.');
    }

    //metodo para ver los posts de una categoria especifica que mandaremos por parametro
    public function verPostsCategoria(Category $category){
        $posts=Post::where('category_id', $category->id)->where('publicado', "SI")->paginate(5);
        $nombre=$category->nombre;
       return view('posts.postscategoria', compact('posts', 'nombre'));
    }
}
