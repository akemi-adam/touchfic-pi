@extends('layouts.main')

@section('title', 'Editar perfil - Touchfic')

@section('content')
    <h2 class="title">
        Editar perfil
    </h2>

    <div class="profile-form">
        <form action="{{ route('user.update', $user->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <label for="name">Nome </label>
            <input type="text" name="name">
            
            <label for="email">E-mail </label>
            <input type="email" name="email">
           
            <label for="biography">Biografia</label>
            <textarea name="biography" cols="30" rows="10"></textarea>

            <label for="avatar">Avatar</label>
            <input type="file" name="avatar">
           
            <button class="submit-button">
                Salvar alterações
            </button>
        </form>
    </div>
@endsection
