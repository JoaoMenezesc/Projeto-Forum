@extends('admin.layouts.app')

@section('title', 'Criar Post')

@section('content')
    <h1 class="text-2xl font-bold mb-4 text-gray-800 dark:text-gray-100">Criar Novo Post</h1>

    <div class="container bg-white dark:bg-gray-800 p-4 rounded-lg shadow-md">
        <form action="{{ route('posts.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="title" class="block text-gray-700 dark:text-gray-200 font-medium mb-2">Título</label>
                <input type="text" id="title" name="title" value="{{ old('title') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-100 dark:border-gray-600 dark:focus:ring-blue-600" required>
                @error('title')
                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="content" class="block text-gray-700 dark:text-gray-200 font-medium mb-2">Conteúdo</label>
                <textarea id="content" name="content" rows="6" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-100 dark:border-gray-600 dark:focus:ring-blue-600" required>{{ old('content') }}</textarea>
                @error('content')
                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="flex justify-between">
                <a href="{{ route('posts.index') }}" class="inline-block px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600 dark:bg-gray-600 dark:hover:bg-gray-700">Cancelar</a>
                <button type="submit" class="inline-block px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 dark:bg-blue-600 dark:hover:bg-blue-700">Criar Post</button>
            </div>
        </form>
    </div>
@endsection

