<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index() {
    $users = User::orderBy('id', 'desc')->paginate(10);
    return view("admin.users.index", compact("users"));
    }    


    public function create(){
        return view("admin.users.create");
    }
   
    public function store(StoreUserRequest $request) {
        User::create($request->all());
        return redirect()
        ->route("users.index")
        ->with("success","Usuario criado com sucesso!");
    }

    public function edit(string $id) {
        //$user = User::where('id', '=', $id)->first();
        if (!$user = User::find($id)){
            return redirect()->route("users.index")->with("error","Usuário não encontrado!");
        }

        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, string $id) {
        if (!$user = User::find($id)){
            return back()->with('error','Usuário não encontrado!');
        }
        $data = $request->only('name', 'email');
        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }
 
        $user->update($data);
        return redirect()->route("users.index")->with("success","Usuário atualizado com sucesso!");
    }
        public function show(string $id) {
            if (!$user = User::find($id)){
                return back()->with('error','Usuário não encontrado!');
            }
            return view('admin.users.show', compact('user'));
        }

        public function destroy(string $id) {
            if (!$user = User::find($id)){
                return back()->with('error','Usuário não encontrado!');
            }

            $user->delete();
            return redirect()->route("users.index")->with("success","Usuário deletado com sucesso!");
        }
}

