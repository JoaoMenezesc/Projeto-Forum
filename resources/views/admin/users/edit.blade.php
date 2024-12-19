@extends('admin.layouts.app')

@section('title', 'editar o usuário')

@section('content')
<h1>Novo Usuario: {{$user->name}}</h1>

<form action="{{route('users.update', $user->id)}}" method="post">
    @method('put')
    @include('admin.users.partials.form')
</form>

@endsection