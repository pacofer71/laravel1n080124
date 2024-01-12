@extends('plantillas.principal')
@section('titulo')
    Inicio Posts
@endsection
@section('cabecera')
    Posts Del sitio
@endsection
@section('contenido')
    <div class="my-2 flex flex-row-reverse">
        <a href="{{ route('posts.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"><i
                class="fas fa-add"></i> NUEVO</a>
    </div>
    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        DETALLE
                    </th>
                    <th scope="col" class="px-6 py-3">
                        TITULO
                    </th>
                    <th scope="col" class="px-6 py-3">
                        CATEGORIA
                    </th>
                    <th scope="col" class="px-6 py-3">
                        PUBLICADO
                    </th>
                    <th scope="col" class="px-6 py-3">
                        ACCIONES
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $item)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <a href="{{ route('posts.show', $item) }}"><i class="fas fa-info text-xl text-blue-500"></i></a>
                        </th>
                        <td class="px-6 py-4">
                            {{ $item->titulo }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $item->category->nombre }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div @class([
                                    'h-3 w-3 rounded-full me-2',
                                    'bg-green-500' => $item->publicado == 'SI',
                                    'bg-red-500' => $item->publicado == 'NO',
                                ])></div> {{ $item->publicado }}
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <form action="{{route('posts.destroy', $item)}}" method="POST">
                            @csrf
                            @method('delete')
                            <a href="{{route('posts.edit', $item)}}" class="mr-2">
                                <i class="fas fa-edit text-black hover:text-xl"></i>
                            </a>
                            <button type="submit">
                                <i class="fas fa-trash text-red-500 hover:text-xl"></i>
                            </button>
                            </form>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
    <div class="mt-2">
        {{ $posts->links() }}
    </div>
@endsection
@section('mensajes')
    @if (session('info'))
        <script>
            Swal.fire({
                icon: "success",
                title: "{{session('info')}}",
                showConfirmButton: false,
                timer: 2000
            });
        </script>
    @endif
@endsection
