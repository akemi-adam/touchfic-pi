@extends('layouts.main')

@section('title', $chapter->storie->title . ": $chapter->title - Touchfic")

@section('content')
    <main class="container-chapter">
        <div class="div-chapter">
            <h1>{{$chapter->title}}</h1>
            <h4><a href="{{ route('storie.show', $chapter->storie->id) }}" style="text-decoration: none">{{$chapter->storie->title}}</a></h4>
            @if ($chapter->created_at === $chapter->updated_at)
                <small class="chapter-info">Data: {{$chapter->created_at}}</small>
            @else
                <small class="chapter-info">Data: {{$chapter->updated_at}}</small>            
            @endif
            <small class="chapter-info"> | Número de palavras: {{$chapter->numberofwords}}</small>
            
            @if (isset($chapter->authornotes))
                <div class="author-notes" oncopy="return false" onpaste="return false" oncontextmenu="return false" ondragstart="return false" ondrop="return false">
                    <h2>Notas do autor</h2>
                    <span>
                        {!!nl2br(e($chapter->authornotes))!!}
                    </span>
                </div>
            <hr>
            @endif

            @if (!is_null($chapter->spotify_track))
                <iframe class="spotify-track" src="https://open.spotify.com/embed/track/{{$chapter->spotify_track}}?utm_source=generator" width="100%" height="152" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>
            @endif
            
            <div class="chapter">
                <p class="chapter-text-indent" style="text-align: justify" oncopy="return false" onpaste="return false" oncontextmenu="return false" ondragstart="return false" ondrop="return false">
                {!!nl2br(e($chapter->content))!!}
                </p>
            </div>
        </div>
    </div>

    <div class="chapter-buttons">
        @if (!is_null($previous))
            <form action="{{ route('chapter.show', $previous) }}" method="get" class="previous">
                <button>
                <i class="fa-solid fa-chevron-left"></i> Anterior
                </button>
            </form>
        @endif
        @if (!is_null($next))
            <form action="{{ route('chapter.show', $next) }}" method="get" class="next">
                <button>
                    Próximo <i class="fa-solid fa-chevron-right"></i>
                </button>
            </form>
        @endif
    </div>

    <hr>
    
    @livewire('comment', [
        'model' => 'App\Models\Commentchapter',
        'foreignCollumn' => 'chapter_id',
        'foreignId' => $chapter->id,
        'comments' => $chapter->comments,
        'editRoute' => 'chapter.comment.edit',
        'publication' => $chapter
    ])
@endsection