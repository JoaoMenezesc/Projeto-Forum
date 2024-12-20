@extends('admin.layouts.app')

@section('title', 'Detalhes do Post')

@section('content')
    <h1 class="text-2xl font-bold mb-4 text-gray-800 dark:text-gray-100">{{ $post->title }}</h1>

    <div class="container bg-white dark:bg-gray-800 p-4 rounded-lg shadow-md">
        <p class="text-gray-700 dark:text-gray-200">{{ $post->content }}</p>

        <div class="mt-4">
            <a href="{{ route('posts.index') }}" class="inline-block px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600 dark:bg-gray-600 dark:hover:bg-gray-700">Voltar</a>
        </div>
    </div>
@endsection
