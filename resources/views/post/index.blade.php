@extends('layouts.main')

@section('title', 'Postagens')
    
@section('content')
    <div class="container-posts">
        <div class="div-posts">
            <h3>
                Postagens
            </h3>
            @forelse ($posts as $post)
                <img src="{{asset('storage/images/user/avatar/' . $post->user->avatar)}}" alt="" class="avatar">
                <p>
                    <strong>
                        {{ $post->user->name }} disse:
                    </strong>
                    <br>
                    {{ $post->content }}
                    <br>
                    @can('authenticated')
                        @if (Auth::user()->id === $post->user_id)
                            <form action="{{ route('post.destroy', $post->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button>Deletar</button>
                            </form>
                        @endif
                        @if (Auth::user()->permission_id === 2 || Auth::user()->permission_id === 3)
                            <form action="{{ route('moderator.post.destroy', $post->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button>Deletar como moderador</button>
                            </form>
                        @endif
                    @endcan
                    <a href="{{ route('post.show', $post->id) }}">Ver mais</a>
                    <br>
                </p>
            @empty
                <h2>Ninguém publicou nada ainda. Seja o primeiro!</h2>
            @endforelse
            <a href="{{ route('post.create') }}" class="post-button">
                <i class="fa-solid fa-circle-plus"></i> Crie uma postagem
            </a>
        </div>
    </div>
@endsection