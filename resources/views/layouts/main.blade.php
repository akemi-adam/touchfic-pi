<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Ícones --}}
    <link rel="shortcut icon" href="https://cdn-icons-png.flaticon.com/512/3629/3629072.png">
    <script src="https://kit.fontawesome.com/f17bb9c677.js" crossorigin="anonymous"></script>
    
    {{-- CSS da Aplicação --}}
    <link rel="stylesheet" href="/css/style.css">

    {{-- Fonte do Google --}}
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Manrope:wght@300&family=Poppins:ital,wght@0,300;0,400;1,300&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
    </style>

    {{-- Seção de Título --}}
    <title>
        @yield('title')
    </title>

    {{-- Seção para JavaScript --}}
    @yield('scripts')

    {{-- Livewire --}}
    @livewireStyles
</head>
<body>

    {{-- Header --}}
    <header>
        <div>
            @if (!Auth::check())
                <a href="{{route('root.home')}}" class="logo"><img src="https://cdn-icons-png.flaticon.com/512/3629/3629072.png" alt="touchfic">touchfic</a>
            @else
                <a href="{{route('dashboard')}}" class="logo"><img src="https://cdn-icons-png.flaticon.com/512/3629/3629072.png" alt="touchfic">touchfic</a>
            @endif
        </div>
        @if (Auth::check())
            <div class="search-bar">
                <form action="{{ route('search') }}" method="get">
                    <input type="text" name="argument" placeholder="Pesquisar...">
                    <button><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
            </div>
        @endif
        <nav>
            <ul>
                <li>
                <a href="{{route('storie.index')}}" class="nav-link">Histórias <i class="fa-solid fa-caret-down"></i></a>
                    <ul class="submenu">
                        <li class="nav-link"><a href="{{ route('storie.create') }}"><i class="fa-solid fa-plus"></i> Criar história</a></li>
                        <li class="nav-link"><a href="{{ route('storie.mystories', Auth::user()->id) }}">Minhas histórias</a></li>
                    </ul>
                </li>
                <li><a href="{{route('post.index')}}" class="nav-link">Linha do tempo</a></li>
                <li><a href="{{route('root.about')}}" class="nav-link">Sobre</a></li>
                <li><a href="{{route('root.faq')}}" class="nav-link">FAQ</a></li>
                @if (!Auth::check())
                    <li><a href="{{route('login')}}" class="nav-link">Login</a></li>
                    <li><a href="{{route('register')}}" class="nav-link">Cadastre-se</a></li>
                @endif
            </ul>
        </nav>
    </header>

    {{-- Flash Message --}}
    @if (session('success_msg'))
        <p class="msg msg-success">{{session('success_msg')}}</p>
    @endif

    @if (Auth::check())
        @if (!isset(Auth::user()->email_verified_at))
            <p class="msg msg-danger">
                Seu email ainda não foi verificado! Caso não tenha recebido, clique aqui:
            </p>
            <form action="{{ route('verification.send') }}" method="post" style="display: inline">
                @csrf
                <a href="" onclick="event.preventDefault(); this.closest('form').submit();">reenviar e-mail</a>
            </form>
        @endif
    @endif
    
    {{-- Seção do Conteúdo --}}
    @yield('content')

    {{-- Footer --}}
    <footer>
        <div>
            <p>Touchfic: crie e leia histórias com um só toque</p>
            <ul>
                <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                <li><a href="#"><i class="fa-brands fa-twitter"></i></a></li>
                <li><a href="#"><i class="fa-brands fa-facebook"></i></a></li>
                <li><a href="#"><i class="fa-brands fa-tiktok"></i></a></li>
                <li><a href="#"><i class="fa-brands fa-pinterest"></i></a></li>
            </ul>
        </div>
        <div>
            <ul>
                <li><a href="{{route('root.home')}}">Termos de Uso</a></li>
                <li><a href="{{route('root.home')}}">Política de Privacidade</a></li>
            </ul>
        </div>
        <div class="div-credits">
            <a href="https://www.flaticon.com/br/icones-gratis/tocha" title="tocha ícones">Tocha ícones criados por Freepik - Flaticon</a>
        </div>
    </footer>

    {{-- Livewire --}}
    @livewireScripts
</body>
</html>