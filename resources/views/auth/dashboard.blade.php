@extends('layouts.main')

@section('title', 'Página Inicial - Touchfic')

@section('content')
    <article class="site-content">
        <div class="container-title">
            <h1 class="title">
                Olá, boas-vindas!
            </h1>
        </div>
        @php
            $displayInfo = false;
        @endphp
        @forelse ($recommendations as $recommendation)
            @if (!$displayInfo)
                <h2>
                    Você também pode se interessar:
                </h2>
                @php
                    $displayInfo = true;
                @endphp
            @endif
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