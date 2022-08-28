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
                    {{$chapter->authornotes}}
                </p>
            @endif
            <hr>
            <h2>Capítulo</h2>
            <p class="chapter-text" style="text-align: justify">
                {{$chapter->content}}
            </p>
        </div>
    </div>
@endsection
