@extends('layouts.main')

@section('title', 'Postagens - Touchfic')
    
@section('content')

@can('authenticated')
    <a href="{{ route('post.create') }}" class="post-button">
       <i class="fa-solid fa-plus"></i>
    </a>
@endcan

    <h2 class="title">
        Postagens
    </h2>
    
        <div class="container-posts">

        
            @forelse ($posts as $post)
            <div class="div-posts">
                <div class="username">
                    <img src="{{ FileSupport::getAvatar($post->user->avatar) }}" alt="" class="avatar">
                <p>
                    <strong>
                        <span>{{ $post->user->name }}</span> disse:
                    </strong>
                </div>

                    <div class="post-content">
                        {{ $post->content }}
                    </div>

                    <a href="{{ route('post.show', $post->id) }}">Ver mais</a>
                    
                    <div class="posts-buttons">
                        @can('authenticated')
                            @if (Auth::user()->id === $post->user_id)
                                <form action="{{ route('post.destroy', $post->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button class="delete-storie">Excluir</button>
                                </form>
                            @endif
                            @if (Auth::user()->permission_id === 2 || Auth::user()->permission_id === 3)
                                <form action="{{ route('moderator.post.destroy', $post->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button class="delete-storie">Excluir como moderador</button>
                                </form>
                            @endif
                        @endcan
                    </div>
                    
                </p>
                </div>
            @empty
                <h2 class="central-msg">Ninguém publicou nada ainda. Seja o primeiro!</h2>
            @endforelse
    </div>
@endsection