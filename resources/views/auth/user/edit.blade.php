@extends('layouts.main')

@section('title', 'Editar dados')

@section('content')
    <h2>
        Editar perfil
    </h2>
    <form action="{{ route('user.update', $user->id) }}" method="post">
        @csrf
        @method('put')
        <label for="name">Nome: </label>
        <input type="text" name="name">
        <br>
        <label for="email">Email: </label>
        <input type="email" name="email">
        <button>
            Enviar
        </button>
    </form>
@endsection
