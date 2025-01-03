@extends('admin.layouts.app')

@section('title', 'Listagem dos Usuários')

@section('content')
    <h1 class="text-2xl font-bold mb-4 text-gray-800 dark:text-gray-100">Listagem de Usuários</h1>

    @can('create_user')
    <a href="{{ route('users.create') }}" class="inline-block mb-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 dark:bg-blue-600 dark:hover:bg-blue-700">Adicionar Usuário</a>
    @endcan
    @if(session('success'))
        <div class="alert alert-success bg-green-100 p-4 rounded mb-4 text-green-800 dark:bg-green-700 dark:text-green-200">
            {{ session('success') }}
        </div>
    @endif

    <table class="min-w-full bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-100">
        <thead>
            <tr>
                <th class="px-4 py-2">Nome</th>
                <th class="px-4 py-2">Email</th>
                <th class="px-4 py-2">Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
                <tr class="border-t border-gray-300 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700">
                    <td class="px-4 py-2">{{ $user->name }}</td>
                    <td class="px-4 py-2">{{ $user->email }}</td>
                    <td class="px-4 py-2">
                        @can('edit_user')
                        <a href="{{ route('users.edit', $user->id) }}" class="px-2 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600 dark:bg-yellow-600 dark:hover:bg-yellow-700">Editar</a>
                        @endcan
                        
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline-block ml-2">
                        
                            @csrf
                            @method('DELETE')
                            @can('delete_user')
                            <button type="submit" class="px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600 dark:bg-red-600 dark:hover:bg-red-700">Excluir</button>
                            @endcan
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="px-4 py-2 text-center text-gray-800 dark:text-gray-100">Nenhum usuário encontrado.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $users->links() }}
    </div>
@endsection
