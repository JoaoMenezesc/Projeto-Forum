@extends('admin.layouts.app')

@section('title', 'Listagem dos usuários')

@section('content')
<h1>Tabela de usuários</h1>
<a href="{{route('users.create')}}">Adicionar um novo usuario</a>


<x-alert/>


<table>
        <thead>
            <tr>
                <th>Nome do Usuario</th>
                <th>Email</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
            <tr>
                <td>{{  $user->name  }}</td>
                <td>{{  $user->email  }}</td>
                <td>-</td>
            </tr>

            @empty
            <tr>
                <td colspan="100">Nenhum usuário foi encontrado</td>
            </tr>
            
           
            @endforelse
        </tbody>
    </table>

    {{$users->links()}}
@endsection