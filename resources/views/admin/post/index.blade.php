@extends('admin.layouts.app')

@section('title', 'Listagem de Posts')

@section('content')
    <h1 class="text-3xl font-bold mb-6 text-gray-800 dark:text-gray-100">Listagem de Posts</h1>

    @can('create_post')
        <a href="{{ route('posts.create') }}" class="inline-block mb-6 px-6 py-3 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600 dark:bg-blue-600 dark:hover:bg-blue-700">
            + Adicionar um Post
        </a>
    @endcan

    @if(session('success'))
        <div class="alert alert-success bg-green-100 text-green-800 dark:bg-green-700 dark:text-green-200 p-4 rounded-lg mb-6">
            {{ session('success') }}
        </div>
    @endif

    <div class="space-y-8">
        @foreach($posts as $post)
            <!-- Card de Post -->
            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden border border-gray-200 dark:border-gray-700">
                <div class="p-6">
                    <!-- Título e Conteúdo -->
                    <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">{{ $post->title }}</h2>
                    <p class="text-gray-700 dark:text-gray-400 mt-4 text-lg leading-relaxed">
                        {{ $post->content }}
                    </p>

                    <!-- Ações de Post -->
                    <div class="mt-6 flex items-center gap-4">
                        @can('edit_post', $post)
                            <a href="{{ route('posts.edit', $post->id) }}" class="px-5 py-2 text-sm bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 dark:bg-yellow-600 dark:hover:bg-yellow-700">Editar</a>
                        @endcan
                        @can('delete_post', $post)
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-5 py-2 text-sm bg-red-500 text-white rounded-lg hover:bg-red-600 dark:bg-red-600 dark:hover:bg-red-700">Excluir</button>
                            </form>
                        @endcan
                    </div>
                </div>

                <!-- Aba de Comentários -->
                <div class="bg-gray-50 dark:bg-gray-900 border-t border-gray-200 dark:border-gray-700 p-4">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-4">Comentários</h3>

                    <!-- Listagem de Comentários -->
                    @if($post->comments->isEmpty())
                        <p class="text-gray-600 dark:text-gray-400">Nenhum comentário ainda.</p>
                    @else
                        <ul class="space-y-3">
                            @foreach($post->comments as $comment)
                                <li class="bg-gray-100 dark:bg-gray-800 p-3 rounded-lg shadow">
                                    <div class="flex justify-between items-center">
                                        <strong class="text-gray-800 dark:text-gray-100 text-sm">{{ $comment->user->name }}</strong>
                                        @if(auth()->id() === $comment->user_id)
                                            <div class="flex items-center space-x-2">
                                                <!-- Botão Editar -->
                                                <a href="{{ route('comments.edit', $comment->id) }}" class="px-2 py-1 bg-yellow-500 text-white text-xs rounded-lg hover:bg-yellow-600 dark:bg-yellow-600 dark:hover:bg-yellow-700">Editar</a>

                                                <!-- Botão Excluir -->
                                                <form action="{{ route('comments.destroy', $comment->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="px-2 py-1 bg-red-500 text-white text-xs rounded-lg hover:bg-red-600 dark:bg-red-600 dark:hover:bg-red-700">Excluir</button>
                                                </form>
                                            </div>
                                        @endif
                                    </div>
                                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">{{ $comment->content }}</p>
                                </li>
                            @endforeach
                        </ul>
                    @endif

                    <!-- Formulário para Adicionar Comentário -->
                    @auth
                        <form action="{{ route('comments.store', $post->id) }}" method="POST" class="mt-6">
                            @csrf
                            <textarea name="content" rows="1" class="w-full p-3 rounded-lg border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-100 text-sm" placeholder="Escreva seu comentário..."></textarea>
                            <button type="submit" class="mt-2 px-6 py-2 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600 dark:bg-blue-600 dark:hover:bg-blue-700">Enviar</button>
                        </form>
                    @else
                        <p class="text-gray-700 dark:text-gray-300 mt-4">Faça <a href="{{ route('login') }}" class="text-blue-500 underline">login</a> para comentar.</p>
                    @endauth
                </div>
            </div>
        @endforeach
    </div>
@endsection
