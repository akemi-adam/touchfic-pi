@if (Auth::check())
<div class="sidebar">
    <div class="sb-options">
  			
    <h3>Touchfic</h3>
        <ul>					
            <li><a href="{{route('root.home')}}">Página inicial</a></li>
            <li><a href="{{route('user.show', Auth::user()->id)}}">Meu perfil</a></li>
            <li><a href="{{route('post.index')}}">Linha do tempo</a></li>
        </ul>

    <hr>
        <ul>
            <li><a href="{{route('storie.create')}}">Criar uma história</a></li>
            <li><a href="{{route('storie.mystories', Auth::user()->id)}}">Minhas histórias</a></li>
            <li><a href="{{route('storie.likes', Auth::user()->id)}}">Histórias favoritas</a></li>
        </ul>

    <hr>
        <ul>					
            <li><a href="#">Tema</a></li>
            @if (Auth::check())
            @if (Auth::user()->permission_id === 3)
            <li><a href="{{route('admin.dashboard')}}">Opções de administrador</a></li>
            @endif
            @endif			
        </ul>

    </div>
</div>
@endif