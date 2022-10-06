@extends('layouts.main')

@section('title', $storie->title)

@section('scripts')
    <script src="/js/amountlikes.js" defer></script>
@endsection

@section('content')

<section class="storie-info-container">
    
    <section class="storie-info">

    <div class="storie-title-container">
        <h2 class="storie-title">
            {{ $storie->title }}
        </h2>
    </div>
    
    <div class="cover-container">
        <img src="{{ FileSupport::getCover($storie->cover) }}" class="cover-show">
    </div>
    
    <div class="storie-data-1">
    <p>Escrita por: <a href="{{ route('user.show', $storie->users[0]->id) }}">{{ $storie->users[0]->name }}</a></p>
    <span>Faixa etária: <span style="font-weight: bold;">{{ $storie->agegroup->agegroup }}</span></span>
    <span>Número de palavras: <span style="font-weight: bold;">{{ $storie->numberofwords }}</span></span>
    <span>Data de publicação: <span style="font-weight: bold;">

        @if ($storie->created_at === $storie->updated_at)
            {{ $storie->created_at }}
        @else
            {{ $storie->updated_at }}
        @endif
    </span>
    </span>

    <div class="likes-container">
        <strong><a href="{{route('likes.of.storie', $storie->id)}}" id="likes" value="{{ $amount }}">Curtidas: {{ $amount }}</a></strong>
    

    @can('authenticated')
        @livewire('like', ['storieId' => $storie->id, 'authorId' => $storie->users[0]->id])
    @endcan
    </div>

    <span>Gêneros:</span>
    <ul>
        @foreach ($storie->genres as $genre)
            <li>{{$genre->genre}}</li> 
        @endforeach
    </ul>

    <span>Sinopse:</span>
    <p>{!!nl2br(e($storie->synopsis))!!}</p>
    @can('authenticated')
        @if (Auth::id() === $storie->users[0]->id)
            <form action="{{ route('storie.edit', $storie->id) }}" method="get">
                <button>
                    Editar
                </button>
            </form>
            <form action="{{ route('storie.destroy', $storie->id) }}" method="post">
                @csrf
                @method('delete')
                <button>
                    Deletar
                </button>
            </form>
            <form action="{{ route('chapter.create', $storie->id) }}" method="get">
                <button>Adicionar um capítulo</button>
            </form>
    </div>
        @endif
    @endcan

        <h3 style="font-size: 18pt">
            Capítulos
        </h3>
        @php
        $index = 0;
        @endphp
        @forelse ($storie->chapters as $chapter)

        <div class="chapter-list">
            <h3 style="font-size: 16pt; margin-left: 3em;">{{$index += 1}} | <a href="{{route('chapter.show', $chapter->id)}}" style="color: var(--main-color)">{{$chapter->title}}</a></h3>
            @can('authenticated')
                @if (Auth::id() === $storie->users[0]->id)
                    <form action="{{ route('chapter.edit', $chapter->id) }}" method="get">
                        <button>
                            Editar
                        </button>
                    </form>
                    <form action="{{ route('chapter.destroy', $chapter->id) }}" method="post">
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
        <h2>A história não possui nenhum capítulo</h2>
    @endforelse
    </section>
</section>
@endsection