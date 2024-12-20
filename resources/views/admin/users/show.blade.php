@extends('admin.layouts.app')

@section('title', 'Detalhes do Usuário')

@section('content')

<x-alert/>

<h1 class="text-2xl font-bold mb-6 text-gray-800 dark:text-gray-100">Detalhes do Usuário: {{ $user->name }}</h1>

<ul class="mb-6 bg-white dark:bg-gray-800 p-4 rounded-lg shadow-md border border-gray-200 dark:border-gray-700">
    <li class="text-lg text-gray-700 dark:text-gray-300">
        <strong>Nome:</strong> {{ $user->name }}
    </li>
    <li class="text-lg text-gray-700 dark:text-gray-300 mt-2">
        <strong>Email:</strong> {{ $user->email }}
    </li>
</ul>

@can('isAdmin')
<form action="{{ route('users.destroy', $user->id) }}" method="POST" 
      class="bg-red-50 dark:bg-red-900 p-4 rounded-lg shadow-md border border-red-200 dark:border-red-700"
      onsubmit="return confirm('Tem certeza de que deseja excluir este usuário? Essa ação não pode ser desfeita.');">
    @csrf
    @method('DELETE')
    <button type="submit" 
            class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 dark:bg-red-600 dark:hover:bg-red-700">
        Deletar Usuário
    </button>
</form>
@endcan

@endsection
