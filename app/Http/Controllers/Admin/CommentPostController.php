<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentPostController extends Controller
{
    /**
     * Exibir formulário de criação de um novo comentário.
     */
    public function create(Post $post)
    {
        return view('admin.comments.create', compact('post'));
    }

    /**
     * Armazenar um novo comentário.
     */
    public function store(Request $request, Post $post)
    {
        // Valida o conteúdo do comentário
        $validated = $request->validate([
            'content' => 'required|max:1000',
        ]);

        // Cria o comentário
        $comment = new Comment($validated);
        $comment->user_id = Auth::id(); // Corrigido para usar Auth::id()
        $comment->post_id = $post->id;
        $comment->save();

        return redirect()
            ->route('posts.show', $post->id)
            ->with('success', 'Comentário criado com sucesso!');
    }

    /**
     * Exibir formulário de edição de um comentário.
     */
    public function edit(Comment $comment)
    {
        // Verifica se o usuário tem permissão para editar o comentário
        if ($comment->user_id !== Auth::id()) {
            abort(403, 'Você não tem permissão para editar este comentário.');
        }

        return view('admin.comments.edit', compact('comment'));
    }

    /**
     * Atualizar um comentário existente.
     */
    public function update(Request $request, Comment $comment)
    {
        // Verifica se o usuário tem permissão para atualizar o comentário
        if ($comment->user_id !== Auth::id()) {
            abort(403, 'Você não tem permissão para atualizar este comentário.');
        }

        // Valida o conteúdo
        $validated = $request->validate([
            'content' => 'required|max:1000',
        ]);

        $comment->update($validated);

        return redirect()
            ->route('posts.show', $comment->post_id)
            ->with('success', 'Comentário atualizado com sucesso!');
    }

    /**
     * Excluir um comentário.
     */
    public function destroy(Comment $comment)
    {
        // Verifica se o usuário tem permissão para excluir o comentário
        if ($comment->user_id !== Auth::id() && !Auth::user()->is_admin) {
            abort(403, 'Você não tem permissão para excluir este comentário.');
        }

        $comment->delete();

        return redirect()->route('posts.index')
            ->with('success', 'Comentário excluído com sucesso!');
    }
}
