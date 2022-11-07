@extends('layouts.main')

@section('title', 'Editar perfil')

@section('content')
    <h2>
        Editar perfil
    </h2>
    <form action="{{ route('user.update', $user->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        <label for="name">Nome: </label>
        <input type="text" name="name">
        <br>
        <label for="email">Email: </label>
        <input type="email" name="email">
        <br>
        <label for="biography">
            Biografia
        </label>
        <textarea name="biography" cols="30" rows="10"></textarea>
        <label for="avatar">
            Avatar:
        </label>
        <input type="file" name="avatar">
        <br>
        <button>
            Salvar alterações
        </button>
    </form>
@endsection
