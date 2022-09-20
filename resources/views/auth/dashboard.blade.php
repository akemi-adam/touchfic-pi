@extends('layouts.main')

@section('title', 'Página Inicial - Touchfic')

@section('content')
    <article class="site-content">
        <div class="container-title">
            <h1 class="title">
                Olá, boas-vindas!
            </h1>
        </div>
        @forelse ($recommendations as $recommendation)
            <h2>
                Você também pode se interessar:
            </h2>
            <div class="carousel">
                <h3>
                    <a href="{{ route('storie.show', $recommendation->id) }}">{{ $recommendation->title }}</a>
                </h3>
                <a href="{{ route('storie.show', $recommendation->id) }}">
                    <img src="{{ asset('storage/images/storie/cover/' . $recommendation->cover) }}" alt="{{ $recommendation->title }}" style="width: 500px">
                </a>
            </div>
        @empty
            @livewire('recent-stories')
        @endforelse
    </article>
@endsection