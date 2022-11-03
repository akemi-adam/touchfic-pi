@extends('layouts.main')

@section('title', 'Início - Touchfic')

@section('content')
    <section class="dashboard-container">
            
    <div class="container-title">
            <h1 class="title">
                Olá, {{Auth::user()->name}}!
            </h1>
    </div>
        <div class="dashboard-content">

            <button><i class="fa-solid fa-chevron-left"></i></button>
        @php
            $displayInfo = false;
        @endphp
        @forelse ($recommendations as $recommendation)
            @if (!$displayInfo)
                <h2>
                    Você também pode se interessar
                </h2>
                @php
                    $displayInfo = true;
                @endphp
            @endif
            <div class="carousel">
                <div class="carousel-slider">
                    <div class="storie-card">
                        <a href="{{ route('storie.show', $recommendation->id) }}">
                            <img src="{{ FileSupport::getCover($recommendation->cover) }}" alt="{{ $recommendation->title }}" style="max-width: 300px">
                        </a>
                        <h3>
                            <a href="{{ route('storie.show', $recommendation->id) }}">{{ $recommendation->title }}</a>
                        </h3>
                    </div>
                </div>
            </div>
        @empty
            @livewire('recent-stories')
        @endforelse
        <button><i class="fa-solid fa-chevron-right"></i></button>
        </div>
    </section>
@endsection