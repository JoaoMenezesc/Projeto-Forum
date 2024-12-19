@extends('admin.layouts.app')

@section('content')

<h1>Novo Usuario</h1>

<form action="{{route('users.store')}}" method="post">
    @include('admin.users.partials.form')
</form>



@endsection