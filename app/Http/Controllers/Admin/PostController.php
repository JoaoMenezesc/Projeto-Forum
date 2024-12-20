<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy("created_at","desc")->paginate(10);
        return view('admin.post.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.post.create');
    }

    public function store(Request $request) {
            $validated = $request->validate([
                'title' => 'required|max:255',
                'content' => 'required',
            ]);
        
            Post::create($validated);
        
            return redirect()
                ->route("posts.index")
                ->with("success", "Post criado com sucesso!");
        }

        public function edit ($id) {
            $post = Post::find($id);
            return view('admin.post.edit', compact('post'));
        }

        public function update(Request $request, $id) {
            $post = Post::find($id);
            $validated = $request->validate([
                'title' => 'required|max:255',
                'content' => 'required',
            ]);
        
            // Atualiza o post com os dados validados
            $post->update($validated);
        
            return redirect()
                ->route("posts.index")
                ->with("success", "Post atualizado com sucesso!");
        }   
        
        public function show($id) {
            $post = Post::find($id);
            return view('admin.post.show', compact('post'));    
        }

        public function destroy($id) {
            $post = Post::find($id);
            $post->delete();
            return redirect()
                ->route("posts.index")
                ->with("success", "Post deletado com sucesso!");
        }   

        
        
}
