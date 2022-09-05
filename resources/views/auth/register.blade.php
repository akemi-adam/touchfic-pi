@extends('layouts.main')

@section('title', 'Cadastre-se já!')
    
@section('content')
    <div class="container-title">
        <h1 class="title"><mark>Cadastro</mark></h1>
        <h4 class="subtitle">Desfrute de uma biblioteca diversa e publique a sua própria história com uma conta Touchfic!</h4>
    </div>
    <div class="container-register-form">
        <div class="register-camp">
            <form action="{{route('register')}}" method="post" class="form">
                @csrf
                <label for="name">
                    Nome
                </label>
                <input type="text" name="name" placeholder="nome...">
            
                <label for="email">
                    E-mail
                </label>
                <input type="email" name="email" placeholder="email...">
            
                <label for="password">
                    Senha
                </label>
                <input type="password" name="password" placeholder="senha...">

                <!-- Confirm Password -->
                <label for="password_confirmation">
                    Confirme a senha
                </label>
                <input type="password" id="password_confirmation" name="password_confirmation">
                
                <button class="register-button">
                    Enviar
                </button>
                
                <div>
                    <a href="{{ route('google.login') }}" class="register-link">Fazer registro com o Google</a>
                </div>

                <a href="{{route('login')}}" class="register-link">
                    Tem conta? Entre agora!
                </a>
            </form>
        </div>
    </div>
@endsection