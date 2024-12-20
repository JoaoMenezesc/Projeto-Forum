@extends('admin.layouts.app')

@section('content')
@section('title', 'Criar um post')

<form action="{{ route('posts.store') }}" method="POST" class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md border border-gray-200 dark:border-gray-700">
    @csrf
    @method('POST')
    @include('admin.post.partials.form-post')
</form>



@endsection