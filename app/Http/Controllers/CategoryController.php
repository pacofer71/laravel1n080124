<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorias=Category::orderBy('nombre')->paginate(5);
        return view('categories.inicio', compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.nueva');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre'=>['required', 'string', 'min:4', 'unique:categories,nombre'],
            'descripcion'=>['required', 'string', 'min:8']
        ]);
        //----------Pasamos las validaciones, vamos a guardar la categoria
        Category::create([
            'nombre'=>ucfirst($request->nombre),
            'descripcion'=>ucfirst($request->descripcion)
        ]);
        return redirect()->route('categories.index')->with("info", "Categoria Guardada");

    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('categories.actualizar', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'nombre'=>['required', 'string', 'min:4', 'unique:categories,nombre,'.$category->id],
            'descripcion'=>['required', 'string', 'min:8']
        ]);
        $category->update([
            'nombre'=>ucfirst($request->nombre),
            'descripcion'=>ucfirst($request->descripcion)
        ]);
        return redirect()->route('categories.index')->with("info", "Categoria Editada");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with("info", "Categoria Borrada");

    }
}
