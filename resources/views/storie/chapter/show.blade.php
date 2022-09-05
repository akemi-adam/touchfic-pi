@extends('layouts.main')

@section('title', $chapter->storie->title . ": $chapter->title")

@section('content')
    <div class="container-chapter">
        <div class="div-chapter">
            <h1>{{$chapter->title}}</h1>
            <h4><a href="{{ route('storie.show', $chapter->storie->id) }}" style="text-decoration: none">{{$chapter->storie->title}}</a></h4>
            @if ($chapter->created_at === $chapter->updated_at)
                <small class="chapter-info">Data: {{$chapter->created_at}}</small>
            @else
                <small class="chapter-info">Data: {{$chapter->updated_at}}</small>            
            @endif
            <span class="chapter-info">Número de palavras: {{$chapter->numberofwords}}</span>
            @if (isset($chapter->authornotes))
                <hr>
                <h2>Notas do autor</h2>
                <p class="author-notes">
                    {!!nl2br(e($chapter->authornotes))!!}
                </p>
            @endif
            <hr>
            <h2>Capítulo</h2>
            <p class="chapter-text indent" style="text-align: justify">
                {!!nl2br(e($chapter->content))!!}
            </p>
        </div>
    </div>
    <hr>
    <form action="{{ route('chapter.comment.store', ['chapter'=>$chapter]) }}" method="post">
        @csrf
        <textarea name="content" id="comment" cols="30" rows="10" placeholder="O que você pensa sobre isso?"></textarea>
        <button>
            Enviar
        </button>
        <br>
    </form>
    <hr>
    @forelse ($chapter->comments as $comment)
        <div style="border: solid black 1px">
            <img src="{{asset('storage/images/user/avatar/' . $comment->user->avatar)}}" class="avatar">
            <small><strong>{{ $comment->user->name }} respondeu: </strong></small>
            <p>
                {{ nl2br($comment->content) }}
            </p>
            @can('authenticated')
                @if ($comment->user_id === Auth::user()->id)
                    <form action="{{ route('chapter.comment.edit', $comment->id) }}" method="get">
                        <button>
                            Editar
                        </button>
                    </form>
                    <form action="{{ route('chapter.comment.destroy', $comment->id) }}" method="post">
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
