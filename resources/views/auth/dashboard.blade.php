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
            <div class="carousel">
                <h2>
                    {{ $recommendation->title }}
                </h2>
                <img src="{{ asset('storage/images/storie/cover/' . $recommendation->cover) }}" alt="{{ $recommendation->title }}" style="width: 500px">
            </div>
        @empty
            <h2>
                O usuário não não curtiu nenhuma história
            </h2>
        @endforelse
    </article>
@endsection