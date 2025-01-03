@extends('admin.layouts.app')

@section('title', 'Listagem de Posts')

@section('content')
    <h1 class="text-2xl font-bold mb-4 text-gray-800 dark:text-gray-100">Listagem de Posts</h1>

    @can('create_post')
    <a href="{{ route('posts.create') }}" class="inline-block mb-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 dark:bg-blue-600 dark:hover:bg-blue-700">Adicionar um post</a>
    @endcan
    @if(session('success'))
        <div class="alert alert-success bg-green-100 p-4 rounded mb-4 text-green-800 dark:bg-green-700 dark:text-green-200">
            {{ session('success') }}
        </div>
    @endif

    <table class="min-w-full bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-100">
        <thead>
            <tr>
                <th class="px-4 py-2">Título</th>
                <th class="px-4 py-2">Conteúdo</th>
                <th class="px-4 py-2">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
                <tr class="border-t border-gray-300 dark:border-gray-600">
                    <td class="px-4 py-2">{{ $post->title }}</td>
                    <td class="px-4 py-2">{{ Str::limit($post->content, 50) }}</td>
                    <td class="px-4 py-2">
                        @can('edit_post')
                        <a href="{{ route('posts.edit', $post->id) }}" class="px-2 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600 dark:bg-yellow-600 dark:hover:bg-yellow-700">Editar</a>
                        @endcan
                        @can('delete_post')
                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="inline-block ml-2">
                        @endcan    
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600 dark:bg-red-600 dark:hover:bg-red-700">Excluir</button>
                        </form>
                        
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
