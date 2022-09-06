@extends('layouts.main')

@section('title', 'Login')

@section('content')
<body style="background-color: #EFEFEF">
    <div class="container-register-form">
        <div class="register-camp">
            <form action="{{route('login')}}" method="post">
                @csrf
                <h2>Iniciar sessão</h2>
                <div>
                    <input type="email" name="email" id="email" placeholder="e-mail">
                </div>

                <div>
                    <input type="password" name="password" placeholder="senha">
                </div>

                <button class="register-button">Entrar</button>
            </form>

            <div class="social-media-container">

                <hr>
                    <div class="social-media-google">
                        <a href="{{ route('google.login') }}"><i class="fa-brands fa-google"></i> Entrar com Google</a>
                    </div>

            </div>

            <div>
                <a href="{{route('register')}}">
                    Não tem conta? Cadastre-se grátis!
                </a>
            </div>
        </div>
    </div>
</body>
@endsection