@if (Auth::check())
<div class="sidebar">
    <div class="sb-options">
  			
    <h3>Touchfic</h3>
        <ul>					
            <li><a href="{{route('root.home')}}"><i class="fa-solid fa-hashtag"></i> Página inicial</a></li>
            <li><a href="{{route('user.show', Auth::user()->id)}}"><i class="fa-solid fa-circle-user"></i> Meu perfil</a></li>
            <li><a href="{{route('post.index')}}"><i class="fa-solid fa-bars-staggered"></i> Linha do tempo</a></li>
        </ul>

    <hr>
        <ul>
            <li><a href="{{route('storie.create')}}"><i class="fa-solid fa-circle-plus"></i> Criar uma história</a></li>
            <li><a href="{{route('storie.mystories', Auth::user()->id)}}"><i class="fa-solid fa-book-open-reader"></i> Minhas histórias</a></li>
            <li><a href="{{route('storie.likes', Auth::user()->id)}}"><i class="fa-solid fa-heart"></i> Histórias curtidas</a></li>
        </ul>

    <hr>
        <ul>					
            @if (Auth::check())
            @if (Auth::user()->permission_id === 3)
            <li><a href="{{route('admin.dashboard')}}"><i class="fa-solid fa-gear"></i> Opções de administrador</a></li>
            @endif
            @endif			
        </ul>

    </div>
</div>
@endif