@extends('layouts.main')

@section('title', $post->user->name  . ' disse: "' . $post->content . '" - Touchfic')
    
@section('content')
    <img src="{{ FileSupport::getAvatar($post->user->avatar) }}" class="avatar">
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
     
    @livewire('comment', [
        'model' => 'App\Models\Commentpost',
        'foreignCollumn' => 'post_id',
        'foreignId' => $post->id,
        'comments' => $post->comments,
        'editRoute' => 'post.comment.edit',
        'publication' => $post
    ])
    
@endsection