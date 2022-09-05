@extends('layouts.main')

@section('title', 'Postagem')
    
@section('content')
<br>
    <img src="{{asset('storage/images/user/avatar/' . $post->user->avatar)}}" class="avatar">
    <h2 style="display: inline">
        {{ $post->user->name }} disse:
    </h2>
    <p>
        {!!nl2br(e($post->content))!!}
    </p>
    <small>
        @if ($post->created_at === $post->updated_at)
            {{ $post->created_at }}
        @else
            {{ $post->updated_at }}
        @endif
    </small>
    @can('authenticated')
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
    @endcan
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
    @forelse ($post->comments as $comment)
        <div style="border: solid black 1px">
            <img src="{{asset('storage/images/user/avatar/' . $comment->user->avatar)}}" class="avatar">
            <small><strong>{{ $comment->user->name }} respondeu: </strong></small>
            <p>
                {!!nl2br(e($comment->content))!!}
            </p>
            @can('authenticated')
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
            @endcan
        </div>
    @empty
        <h2>Ninguém comentou nessa postagem ainda. Seja o pioneiro!</h2>
    @endforelse
@endsection