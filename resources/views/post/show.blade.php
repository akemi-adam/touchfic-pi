@extends('layouts.main')

@section('title', 'Postagem')
    
@section('content')
    <h2>
        {{ $user->name }} disse:
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
    @if (Auth::user()->id === $user->id)
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
@endsection