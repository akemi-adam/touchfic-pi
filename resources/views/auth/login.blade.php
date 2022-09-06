@extends('layouts.main')

@section('title', 'Login')

@section('content')
<body style="background-color: #EFEFEF">
    <div class="container-register-form">
        <div class="register-camp">
            <form action="{{route('login')}}" method="post">
                @csrf
                <h2 class="title-auth">Iniciar sessão</h2>
                
                    <input type="email" name="email" id="email" placeholder="E-mail" autofocus>
                

                
                    <input type="password" name="password" placeholder="Senha">
                

                <button class="register-button">Entrar</button>
            </form>

            <div class="social-media-container">

                <hr>
                    <div class="social-media-google">
                        <a href="{{ route('google.login') }}"><i class="fa-brands fa-google"></i> Entrar com Google</a>
                    </div>

            </div>

            <div class="redirect-login-register">
                <a href="{{route('register')}}">
                    Não tem conta? <span>Cadastre-se grátis!</span>
                </a>
            </div>
        </div>
    </div>
</body>
@endsection