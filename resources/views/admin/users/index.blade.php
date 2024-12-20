@extends('admin.layouts.app')

@section('title', 'Listagem dos Usuários')

@section('content')
<h1 class="text-2xl font-bold mb-4 text-gray-800 dark:text-gray-100">Tabela de Usuários</h1>

<a href="{{ route('users.create') }}" 
   class="inline-block mb-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 dark:bg-blue-600 dark:hover:bg-blue-700">
    Novo Usuário
</a>

<x-alert/>

<table class="w-full border-collapse border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm">
    <thead class="bg-gray-100 dark:bg-gray-800">
        <tr>
            <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left text-gray-800 dark:text-gray-100">Nome do Usuário</th>
            <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left text-gray-800 dark:text-gray-100">Email</th>
            <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left text-gray-800 dark:text-gray-100">Ações</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($users as $user)
        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
            <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-gray-800 dark:text-gray-100">{{ $user->name }}</td>
            <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-gray-800 dark:text-gray-100">{{ $user->email }}</td>
            <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">
                <a href="{{ route('users.edit', $user->id) }}" 
                    class="text-yellow-600 dark:text-yellow-300 hover:underline mr-2">
                     Editar
                 </a>
                 
                <a href="{{ route('users.show', $user->id) }}" 
                   class="text-green-500 dark:text-green-400 hover:underline">
                    Visualizar
                </a>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="3" class="text-center border border-gray-300 dark:border-gray-600 px-4 py-2 text-gray-800 dark:text-gray-100">
                Nenhum usuário foi encontrado
            </td>
        </tr>
        @endforelse
    </tbody>
</table>

<div class="mt-4">
    {{$users->links()}}
</div>
@endsection
