@extends('admin.layouts.app')

@section('title', 'Criar um post')

@section('content')
<form 
    action="{{ route('posts.store') }}" 
    method="POST" 
    class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md border border-gray-200 dark:border-gray-700">
    @csrf
    <x-alert/>

    <!-- Título -->
    <div class="mb-4">
        <label 
            for="title" 
            class="text-2xl font-bold text-gray-800 dark:text-gray-100">
            Título:
        </label>
        <input 
            type="text" 
            name="title" 
            id="title" 
            class="w-full mt-2 p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" 
            required>
    </div>

    <!-- Conteúdo -->
    <div class="mb-4">
        <label 
            for="content" 
            class="text-2xl font-bold text-gray-800 dark:text-gray-100">
            Escreva seu recado:
        </label>
        <textarea 
            name="content" 
            id="content" 
            cols="50" 
            rows="10" 
            class="w-full mt-2 p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" 
            required></textarea>
    </div>

    <!-- Tipo de Post -->
    <div class="mb-4">
        <label 
            class="text-2xl font-bold text-gray-800 dark:text-gray-100">
            Público:
            <input 
                type="radio" 
                name="type" 
                value="public" 
                class="ml-2">
        </label>
        <br>
        <label 
            class="text-2xl font-bold text-gray-800 dark:text-gray-100">
            Privado:
            <input 
                type="radio" 
                name="type" 
                value="private" 
                class="ml-2">
        </label>
    </div>

    <!-- Botão de Enviar -->
    <button 
        type="submit" 
        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        Enviar
    </button>
</form>
@endsection
