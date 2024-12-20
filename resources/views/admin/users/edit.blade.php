@extends('admin.layouts.app')

@section('title', 'Editar Usuário')

@section('content')

<h1 class="text-2xl font-bold mb-6 text-gray-800 dark:text-gray-100">Editar Usuário: {{ $user->name }}</h1>

<form action="{{ route('users.update', $user->id) }}" method="POST" 
      class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md border border-gray-200 dark:border-gray-700">
    @csrf
    @method('PUT')
    @include('admin.users.partials.form')

    <div class="py-6">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Atualize os dados do usuário {{ $user->name }}
        </h2>
    </div>

    <div class="mt-4">
        <button type="submit" 
                class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 dark:bg-blue-600 dark:hover:bg-blue-700">
            Salvar Alterações
        </button>
        <a href="{{ route('users.index') }}" 
           class="ml-2 px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600 dark:bg-gray-600 dark:hover:bg-gray-700">
            Cancelar
        </a>
    </div>
</form>

@endsection
