@extends('layouts.main')

@section('title', 'Início - Touchfic')

@section('content')
    <section class="dashboard-container">
            
    <div class="container-title">
            <h1 class="title">
                Boas-vindas, {{Auth::user()->name}}!
            </h1>
    </div>

        
        @php
            $displayInfo = false;
        @endphp
        @forelse ($recommendations as $recommendation)
            @if (!$displayInfo)
                <h2 class="subtitle">
                    Você também pode se interessar
                </h2>
                @php
                    $displayInfo = true;
                @endphp
            @endif
            <div class="dashboard-content">
            <div class="carousel">
                <div class="carousel-slider">

                    <a href="{{ route('storie.show', $recommendation->id) }}">
                    <div class="storie-card">  
                            <img src="{{ FileSupport::getCover($recommendation->cover) }}" alt="{{ $recommendation->title }}" style="max-width: 300px">
                        <h3>
                            {{ $recommendation->title }}
                        </h3>
                        </a>
                    </div>
                    
                </div>
            </div>
        @empty
            @livewire('recent-stories')
        @endforelse
        
        </div>
    </section>
@endsection