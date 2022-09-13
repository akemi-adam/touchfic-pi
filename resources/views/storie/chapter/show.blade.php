@extends('layouts.main')

@section('title', $chapter->storie->title . ": $chapter->title")

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
                <div class="author-notes">
                    <h2>Notas do autor</h2>
                    <span>
                        {!!nl2br(e($chapter->authornotes))!!}
                    </span>
                </div>
            <hr>
            @endif

            <div class="chapter">
                <p class="chapter-text-indent" style="text-align: justify">
                    {!!nl2br(e($chapter->content))!!}
                </p>
            </div>
        </div>
    </main>
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
