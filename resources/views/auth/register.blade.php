@extends('layouts.main')

@section('title')
    
@section('content')
    <div class="container-title">
        <h1 class="title"><mark>Cadastro</mark></h1>
        <h4 class="subtitle">Desfrute de uma biblioteca diversa e publique a sua própria história com uma conta Touchfic!</h4>
    </div>
    <div class="container-register-form">
        <div class="register-camp">
            <form action="/register" method="post" class="form">
                <label for="username">
                    Nome de usuário
                </label>
                <input type="text" name="username" placeholder="Nome de usuário">
            
                <label for="email">
                    E-mail
                </label>
                <input type="email" name="email" placeholder="E-mail">
            
                <label for="password">
                    Senha
                </label>
                <input type="password" name="password" placeholder="Senha">
            
                <button class="register-button">
                    Enviar
                </button>

                <a href="{{route('auth.login.view')}}" class="register-link">
                    Tem conta? Entre agora!
                </a>
            </form>
        </div>
    </div>
@endsection