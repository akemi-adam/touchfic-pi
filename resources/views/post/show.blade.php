@extends('layouts.main')

@section('title', 'Postagem')
    
@section('content')
<br>
    <img src="/img/user/avatar/{{ $post->user->avatar }}" class="avatar">
    <h2 style="display: inline">
        {{ $post->user->name }} disse:
    </h2>
    <p>
        {{ $post->content }}
    </p>
    <small>
        @if ($post->created_at === $post->updated_at)
            {{ $post->created_at }}
        @else
            {{ $post->updated_at }}
        @endif
    </small>
    @if (Auth::user()->id === $post->user->id)
        <br>
        <br>
        <form action="{{ route('post.edit', $post->id) }}" method="get">
            <button>Editar</button>
        </form>
        <form action="{{ route('post.destroy', $post->id) }}" method="post">
            @csrf
            @method('delete')
            <button>
                Deletar
            </button>
        </form>
        <br>
    @endif
    <hr>
    <form action="{{ route('comment.store', ['post'=>$post]) }}" method="post">
        @csrf
        <textarea name="content" id="comment" cols="30" rows="10" placeholder="O que você pensa sobre isso?"></textarea>
        <button>
            Enviar
        </button>
        <br>
    </form>
    <hr>
    @foreach ($post->comments as $comment)
        <div style="border: solid black 1px">
            <img src="/img/user/avatar/{{ $comment->user->avatar }}" class="avatar">
            <small><strong>{{ $comment->user->name }} respondeu: </strong></small>
            <p>
                {{ $comment->content }}
            </p>
            @if ($comment->user_id === Auth::user()->id)
                <form action="{{ route('comment.edit', $comment->id) }}" method="get">
                    <button>
                        Editar
                    </button>
                </form>
                <form action="{{ route('comment.destroy', $comment->id) }}" method="post">
                    @csrf
                    @method('delete')
                    <button>
                        Deletar
                    </button>
                </form>
            @endif
        </div>
    @endforeach
@endsection