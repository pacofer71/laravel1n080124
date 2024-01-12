@extends('plantillas.principal')
@section('titulo')
    Posts categoria
@endsection
@section('cabecera')
    Posts relacionados con {{ $nombre }}
@endsection
@section('contenido')
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 h-full">
        @foreach ($posts as $item)
            <article @class(['h-80 w-full', 'md:col-span-2 lg:col-span-2' => $loop->first])
                style="background-image:url({{ Storage::url($item->imagen) }}); background-size:cover">
                <div class="flex flex-col w-full h-full justify-around">
                    <div class="mx-auto text-xl text-gray-700 font-semibold">
                        {{ $item->titulo }}
                    </div>

                    <div class="mx-auto text-lg mt-8 italic">
                        <span class="px-2 py-2 rounded">{{ $item->publicado }}</span>
                    </div>

                </div>
            </article>
        @endforeach
    </div>
    <div class="mt-2">
        {{ $posts->links() }}
    </div>
@endsection
