<header>

    <div class="header-logo">

        @if (Auth::check())
        <div>
            <span><ion-icon id="smenu" name="menu-outline"></ion-icon></span>
        </div>
        @endif

        @if (!Auth::check())
            <a href="{{route('root.home')}}" class="logo" ondragstart="return false"><img src="/images/icons/touchfic-logo.svg" alt="Touchfic" ondragstart="return false">Touchfic</a>
        @else
            <a href="{{route('dashboard')}}" class="logo" ondragstart="return false"><img src="/images/icons/touchfic-logo.svg" alt="Touchfic" ondragstart="return false">Touchfic</a>
        @endif
        
    </div>
    
        <div>
            <form action="{{ route('search') }}" method="get" class="search-form" autocomplete="off">
                @if (isset($search))
                    <span><i class="fa-solid fa-magnifying-glass"></i></span>
                    <input type="text" name="search" placeholder="Pesquisar" value="{{ $search }}" required>
                @else
                    <span><i class="fa-solid fa-magnifying-glass"></i></span>
                    <input type="text" name="search" placeholder="Pesquisar" required>
                @endif
            </form>
        </div>

    <nav>
        <ul>
            <li>
            @if (!Auth::check())
            <a href="{{route('storie.index')}}" class="nav-link">Histórias</a>
            @else
            <a href="{{ route('storie.index') }}" class="nav-link">Histórias</a>
            @endif
                    @can('authenticated')
                    <ul class="submenu">
                        <li class="nav-link"><a href="{{ route('storie.create') }}"><i class="fa-solid fa-plus"></i> Criar história</a></li>
                        <li class="nav-link"><a href="{{ route('storie.mystories', Auth::user()) }}">Minhas histórias</a></li>
                        <li class="nav-link"><a href="{{ route('storie.likes', Auth::id()) }}">Histórias curtidas</a></li>
                    </ul>
                    @endcan
            </li>
            <li><a href="{{route('post.index')}}" class="nav-link">Linha do tempo</a></li>

            @can('authenticated')
            <li>
            <a href="{{route('user.show', Auth::id())}}" class="nav-link">{{Auth::user()->name}}</a>
                <ul class="submenu">
                    <li class="nav-link">
                        <a href="{{route('user.notifications')}}">
                            Notificações
                            @if (!empty(Auth::user()->unreadNotifications[0]))
                                <i class="fa-solid fa-circle-exclamation"></i>
                            @endif
                        </a>
                        
                    </li>
                    <form action="{{route('logout')}}" method="post">
                        @csrf
                        <li class="nav-link"><a onclick="event.preventDefault(); this.closest('form').submit();"><i class="fa-solid fa-right-from-bracket"></i> Sair</a></li>
                    </form>
                </ul>
            </li>
            @endcan

            @if (!Auth::check())
                <li><a href="{{route('login')}}" class="nav-link">Login</a></li>
                <li><a href="{{route('register')}}" class="nav-link">Cadastre-se</a></li>
            @endif
        </ul>
    </nav>
</header>