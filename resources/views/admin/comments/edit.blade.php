@extends('admin.layouts.app')

@section('title', 'Editar Comentário')

@section('content')
    <h1 class="text-2xl font-bold mb-4 text-gray-800 dark:text-gray-100">Editar Comentário</h1>

    <!-- Verifica se há erros de validação -->
    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('comments.update', ['comment' => $comment->id]) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label for="content" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Conteúdo do Comentário</label>
            <textarea
                id="content"
                name="content"
                rows="3"
                class="w-full p-2 border border-gray-300 rounded dark:bg-gray-800 dark:text-gray-100 @error('content') border-red-500 @enderror"
            >{{ old('content', $comment->content) }}</textarea>

            <!-- Mensagem de erro para o campo conteúdo -->
            @error('content')
                <span class="text-sm text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 dark:bg-blue-600 dark:hover:bg-blue-700">
                Atualizar
            </button>
        </div>
    </form>
@endsection
