@extends('plantillas.principal')
@section('titulo')
    Editar Categoria
@endsection
@section('cabecera')
    Editar Categoria
@endsection
@section('contenido')
    <div class="w-1/2 mx-auto p-6 rounded-xl shadow-xl bg-gray-300">
        <form method="POST" action="{{route('categories.update', $category)}}">
            @csrf
            @method('put')
            <div class="mb-5">
                <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">NOMBRE</label>
                <input type="text" id="nombre" value="{{$category->nombre}}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Nombre..." name="nombre">
                    @error('nombre')
                    <p class="mt-2 text-red-500 italic text-sm">*** {{$message}}</p>
                    @enderror
            </div>
            <div class="mb-5">
                <label for="desc"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">DESCRIPCION</label>
                <textarea type="email" id="desc" name="descripcion"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Descripcion...">{{$category->descripcion}}</textarea>
                    @error('descripcion')
                    <p class="mt-2 text-red-500 italic text-sm">*** {{$message}}</p>
                    @enderror
            </div>
            <div class="flex flex-row-reverse">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    <i class="fas fa-edit"></i> EDITAR
                </button>
                <button type="reset" class="mx-2 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    <i class="fas fa-paintbrush"></i> LIMPIAR
                </button>
                <a href="{{route('categories.index')}}" class="mr-2 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                <i class="fas fa-xmark"></i> CANCELAR</a>
            </div>
        </form>
    </div>
@endsection
