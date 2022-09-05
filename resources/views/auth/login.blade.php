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
            <form action="{{route('login')}}" method="post">
                @csrf
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="email...">

                <label for="password">Senha</label>
                <input type="password" name="password" placeholder="senha...">
                <button class="register-button">
                    Enviar
                </button>
            </form>
            <div>
                <a href="{{ route('google.login') }}" class="register-link">Fazer login com o Google</a>
            </div>
            <a href="{{route('register')}}" class="register-link">
                Ou cadastre-se grátis!
            </a>
        </div>
    </div>

@endsection