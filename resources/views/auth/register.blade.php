@extends('layouts.auth')

@section('title', 'Cadastre-se já!')
    
@section('content')
<body>
    <div class="container-register-form">
        <div class="register-camp">
            <form action="{{route('register')}}" method="post" class="form">
                @csrf
                <h2 class="title-auth">Criar uma conta</h2>
                <input type="text" name="name" placeholder="Nome" autofocus>
            
                <input type="email" name="email" placeholder="E-mail">
            
                <input type="password" name="password" placeholder="Senha">

                <!-- Confirm Password -->
                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirmar senha">
                
                <button class="auth-button">
                    Criar conta
                </button>

                <hr>
                <div class="social-media-google">
                    <a href="{{ route('google.login') }}"><i class="fa-brands fa-google"></i> Cadastrar com Google</a>
                </div>

                <div class="redirect-login-register">
                    <a href="{{route('login')}}">
                        Já tem uma conta? <span>Entre agora!</span>
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
@endsection