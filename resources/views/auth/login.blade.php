@extends('layouts.main')

@section('title', 'Faça login!')

@section('content')
    <div class=container-title>
        <h1 class="title">
            <mark>Entre com sua conta Touchfic</mark>
        </h1>
    </div>

    <div class="container-register-form">
        <div class="register-camp">
            <form action="/login" method="post">
                <label for="username">Nome de usuário</label>
                <input type="text" name="username" id="username" placeholder="Nome de usuário">

                <label for="password">Senha</label>
                <input type="password" name="password" placeholder="Senha">
                <button class="register-button">
                    Enviar
                </button>
            </form>
            <a href="{{route('auth.register.view')}}" class="register-link">
                Ou cadastre-se grátis!
            </a>
        </div>
    </div>

@endsection