<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Ícones --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <script src="https://kit.fontawesome.com/f17bb9c677.js" crossorigin="anonymous"></script>
    
    {{-- CSS da Aplicação --}}
    <link rel="stylesheet" href="/css/style.css">

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
                <a href="{{route('root.home')}}" class="logo"><img src="/images/icons/touchfic-logo.svg" alt="touchfic">Touchfic</a>
            @else
                <a href="{{route('dashboard')}}" class="logo"><img src="/images/icons/touchfic-logo.svg" alt="touchfic">Touchfic</a>
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
                @can('authenticated')
                <li>
                <a href="{{route('user.show', Auth::user()->id)}}" class="nav-link">{{Auth::user()->name}}</a>
                    <ul class="submenu">
                        <li class="nav-link">
                            <a href="{{route('user.notifications')}}">
                                Notificações
                                @if (!empty(Auth::user()->unreadNotifications[0]))
                                    <i class="fa-solid fa-circle"></i>
                                @endif
                            </a>
                            
                        </li>
                        <form action="{{route('logout')}}" method="post">
                            @csrf
                            <li class="nav-link"><a onclick="event.preventDefault(); this.closest('form').submit();">Sair</a></li>
                        </form>
                    </ul>
                </li>
                @endcan
                <li>
                <a href="{{route('storie.index')}}" class="nav-link">Histórias</a>
                        @can('authenticated')
                        <ul class="submenu">
                            <li class="nav-link"><a href="{{ route('storie.create') }}"><i class="fa-solid fa-plus"></i> Criar história</a></li>
                            <li class="nav-link"><a href="{{ route('storie.mystories', Auth::user()->id) }}">Minhas histórias</a></li>
                            <li class="nav-link"><a href="{{ route('storie.likes', Auth::user()->id) }}">Histórias favoritas</a></li>
                        </ul>
                        @endcan
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
                Seu e-mail ainda não foi verificado! Caso não tenha recebido, clique aqui:
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
            <span>&copy; Touchfic</span>
        </div>
    </footer>

    {{-- Livewire --}}
    @livewireScripts
</body>
</html>