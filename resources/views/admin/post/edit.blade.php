@extends('admin.layouts.app')

@section('title', 'Editar Post')

@section('content')
    <h1 class="text-2xl font-bold mb-4 text-gray-800 dark:text-gray-100">Editar Post</h1>

    <!-- Formulário para editar o post -->
    <div class="container bg-white dark:bg-gray-800 p-4 rounded-lg shadow-md">
        <form action="{{ route('posts.update', $post->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Campo de Título -->
            <div class="mb-4">
                <label for="title" class="block text-gray-700 dark:text-gray-200 font-medium mb-2">Título</label>
                <input 
                    type="text" 
                    id="title" 
                    name="title" 
                    value="{{ old('title', $post->title) }}" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-100 dark:border-gray-600 dark:focus:ring-blue-600" 
                    required
                >
                @error('title')
                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                @enderror
            </div>

            <!-- Campo de Conteúdo -->
            <div class="mb-4">
                <label for="content" class="block text-gray-700 dark:text-gray-200 font-medium mb-2">Conteúdo</label>
                <textarea 
                    id="content" 
                    name="content" 
                    rows="6" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-100 dark:border-gray-600 dark:focus:ring-blue-600" 
                    required
                >{{ old('content', $post->content) }}</textarea>
                @error('content')
                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                @enderror
            </div>

            <!-- Botões -->
            <div class="flex justify-between">
                <a href="{{ route('posts.index') }}" class="inline-block px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600 dark:bg-gray-600 dark:hover:bg-gray-700">Cancelar</a>
                <button type="submit" class="inline-block px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 dark:bg-blue-600 dark:hover:bg-blue-700">
                    Atualizar Post
                </button>
            </div>
        </form>
    </div>
@endsection
