@extends('layouts.main')

@section('title', $post->user->name  . ' disse: "' . $post->content . '" - Touchfic')
    
@section('content')
<div class="post-containers">
<div class="post-contents">

<div class="featured-post">
    <div class="featured-posts">
    <div class="featured-post-user">
        <img src="{{ FileSupport::getAvatar($post->user->avatar) }}" class="avatar">
        <strong>
            <span>{{ $post->user->name }}</span> disse:
        </strong>
    </div>

    <div class="post-content">
        <p>
            {!!nl2br(e($post->content))!!}
        </p>
    </div>

    <small>
        @if ($post->created_at === $post->updated_at)
            {{ $post->created_at }}
        @else
            {{ $post->updated_at }}
        @endif
    </small>
   

    <div class="posts-buttons">
    @can('authenticated')
        @if (Auth::user()->id === $post->user->id)
            <form action="{{ route('post.edit', $post->id) }}" method="get">
                <button class="edit-storie">Editar</button>
            </form>
            <form action="{{ route('post.destroy', $post->id) }}" method="post">
                @csrf
                @method('delete')
                <button class="delete-storie">
                    Excluir
                </button>
            </form>
            </div>
            </div>
        @endif
    @endcan
</div>

    
    @livewire('comment', [
        'model' => 'App\Models\Commentpost',
        'foreignCollumn' => 'post_id',
        'foreignId' => $post->id,
        'comments' => $post->comments,
        'editRoute' => 'post.comment.edit',
        'publication' => $post
    ])
</div>
</div>
@endsection