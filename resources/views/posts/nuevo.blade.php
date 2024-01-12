@extends('plantillas.principal')
@section('titulo')
    Nuevo Post
@endsection
@section('cabecera')
    Crear Post
@endsection
@section('contenido')
    <div class="w-1/2 mx-auto p-6 rounded-xl shadow-xl bg-gray-300">
        <form method="POST" action="{{ route('posts.store') }}">
            @csrf
            <div class="mb-5">
                <label for="titulo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Título</label>
                <input type="text" id="titulo" value="{{old('titulo')}}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Nombre..." name="titulo">
                @error('titulo')
                    <p class="mt-2 text-red-500 italic text-sm">*** {{ $message }}</p>
                @enderror
            </div>
            <div class="mb-5">
                <label for="contenido"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">CONTENIDO</label>
                <textarea id="contenido" name="contenido"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Descripcion...">{{old('contenido')}}</textarea>
                @error('contenido')
                    <p class="mt-2 text-red-500 italic text-sm">*** {{ $message }}</p>
                @enderror
            </div>
            <div class="mb-5">
                <label for="categoria" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Seleccione una
                    categoria</label>
                <select id="titulo"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    name="category_id">
                    <option>---- Seleccione una Categoria ----</option>
                    @foreach($categorias as $item)
                    <option value="{{$item->id}}">{{$item->nombre}}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="mt-2 text-red-500 italic text-sm">*** {{ $message }}</p>
                @enderror
            </div>
            <div class="mb-5">
                <label for="publicado" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Publicar</label>
                <div class="flex items-center mb-4">
                    <input id="publicado" type="checkbox" value="SI" name="publicado" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="publicado" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">SI</label>
                </div>
            </div>
            <div class="mb-4">
                <div class="flex w-full">
                    <div class="w-1/2 mr-2">
                        <label for="imagen" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            IMAGEN</label>
                        <input type="file" id="imagen" oninput="img.src=window.URL.createObjectURL(this.files[0])"
                            name="imagen" accept="image/*"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                        @error('imagen')
                        <p class="mt-2 text-red-500 italic text-sm">*** {{ $message }}</p>

                        @enderror
                    </div>
                    <div class="w-1/2">
                        <img src="{{ Storage::url('posts/noimage.png') }}"
                            class="h-72 rounded w-full object-cover border-4 border-black" id="img">
                    </div>
                </div>
    
            </div>
            <div class="flex flex-row-reverse">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    <i class="fas fa-save"></i> GUARDAR
                </button>
                <button type="reset" class="mx-2 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    <i class="fas fa-paintbrush"></i> LIMPIAR
                </button>
                <a href="{{ route('posts.index') }}"
                    class="mr-2 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                    <i class="fas fa-xmark"></i> CANCELAR</a>
            </div>
        </form>
    </div>
@endsection
