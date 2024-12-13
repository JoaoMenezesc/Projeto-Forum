@extends('admin.layouts.app')

@section('content')

<h1>Novo Usuario</h1>


<x-alert/>

<form action="{{route('users.store')}}" method="post">



    @csrf()
    <input type="text" name="name" placeholder="name" value="{{old('name')}}">
    <input type="email" name="email" placeholder="email" value="{{old('email')}}">
    <input type="password" name="password" placeholder="password"> 
    <button type="submit">Enviar</button>
</form>

@endsection