@extends('layouts.main')

@section('title', 'Postagens')
    
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

        <div class="div-posts">
            @forelse ($posts as $post)
                <img src="{{ FileSupport::getAvatar($post->user->avatar) }}" alt="" class="avatar">
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
        </div>
    </div>
@endsection