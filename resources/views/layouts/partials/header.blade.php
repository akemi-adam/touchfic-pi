<header>
    <div>
        @if (!Auth::check())
            <a href="{{route('root.home')}}" class="logo" ondragstart="return false"><img src="/images/icons/touchfic-logo.svg" alt="Touchfic" ondragstart="return false">Touchfic</a>
        @else
            <a href="{{route('dashboard')}}" class="logo" ondragstart="return false"><img src="/images/icons/touchfic-logo.svg" alt="Touchfic" ondragstart="return false">Touchfic</a>
        @endif
    </div>
    @if (Auth::check())
        <div class="search-bar">
            <form action="{{ route('search') }}" method="get">
                @if (isset($argument))
                    <input type="text" name="argument" placeholder="Pesquisar..." value="{{ $argument }}">
                    <button><i class="fa-solid fa-magnifying-glass"></i></button>
                @else
                    <input type="text" name="argument" placeholder="Pesquisar...">
                    <button><i class="fa-solid fa-magnifying-glass"></i></button>
                @endif
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