<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index(Request $request)
    {
        // Filtragem de posts
        $query = Post::query();

    // Filtro pelo título
    if ($request->has('title') && $request->title != '') {
        $query->where('title', 'like', '%' . $request->title . '%');
    }

    // Filtro pelo tipo de post
    if ($request->has('type') && $request->type != '') {
        $query->where('type', $request->type); // Supondo que o campo seja 'type' com valores 'public' e 'private'
    }

        // Paginação de 10 posts por página
        $posts = $query->with('comments')->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.post.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.post.create');
    }

    public function store(Request $request)
    {
        // Validação de entrada
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'type' => 'required|in:public,private',
        ]);

        // Criação do post associando ao usuário autenticado
        Post::create(array_merge($validated, ['user_id' => Auth::id()]));

        return redirect()
            ->route('posts.index')
            ->with('success', 'Post criado com sucesso!');
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);

        // Verifica se o usuário tem permissão para editar
        if ($post->user_id !== Auth::id()) {
            abort(403, 'Você não tem permissão para editar este post.');
        }

        return view('admin.post.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        // Validação de entrada
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'type' => 'required|in:public,private',
        ]);

        // Verifica se o usuário tem permissão para editar
        if ($post->user_id !== Auth::id()) {
            abort(403, 'Você não tem permissão para editar este post.');
        }

        $post->update($validated);

        return redirect()
            ->route('posts.index')
            ->with('success', 'Post atualizado com sucesso!');
    }

    public function show($id)
    {
        $post = Post::with('comments.user')->findOrFail($id);

        // Verifica se o post é público ou pertence ao usuário autenticado
        if ($post->type === 'private' && $post->user_id !== Auth::id()) {
            abort(403, 'Você não tem permissão para visualizar este post.');
        }

        return view('admin.post.show', compact('post'));
    }

    public function destroy(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        // Verifica se o usuário tem permissão para deletar
        if ($post->user_id !== Auth::id()) {
            abort(403, 'Você não tem permissão para deletar este post.');
        }

        $post->delete();

        return redirect()->route('posts.index');
    }
}
