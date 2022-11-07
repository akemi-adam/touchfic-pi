@extends('layouts.main')

@section('title', $storie->title . ' - Touchfic')

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
    <p>Escrita por: <a href="{{ route('user.show', $storie->users[0]->id) }}"><img src="{{ FileSupport::getAvatar($storie->users[0]->avatar)}}" alt=""> {{ $storie->users[0]->name }}</a></p>
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
        <a href="{{route('likes.of.storie', $storie->id)}}" id="likes" value="{{ $amount }}">Curtidas: {{ $amount }}</a>
    
        @can('authenticated')
            @livewire('like', ['storieId' => $storie->id, 'authorId' => $storie->users[0]->id])
        @endcan
    </div>

    <div class="storie-features">
        <span style="font-size: 14pt;">Gêneros:</span>
        <span style="font-weight: bold">
        @for ($i = 0; $i < count($storie->genres); $i++)
        
            @if ($i !== (count($storie->genres) - 1))
                {{ $storie->genres[$i]->genre }}<span style="font-weight: normal">,</span> 
            @else
                {{ $storie->genres[$i]->genre }}<span style="font-weight: normal">.</span>
            @endif

        @endfor
        </span>
    </div>

    <div class="storie-features">
        <p style="margin-top: 0;">Sinopse:</p>
        <span>{!!nl2br(e($storie->synopsis))!!}</span>
    </div>

        <div class="storie-crud">
    @can('authenticated')
        @if (Auth::id() === $storie->users[0]->id)
            <form action="{{ route('chapter.create', $storie->id) }}" method="get">
                <button class="add-chapter">
                    <i class="fa-solid fa-plus"></i> Adicionar um capítulo
                </button>
            </form>

            <form action="{{ route('storie.edit', $storie->id) }}" method="get">
                <button class="edit-storie">
                    Editar história
                </button>
            </form>

            <form action="{{ route('storie.destroy', $storie->id) }}" method="post">
                @csrf
                @method('delete')
                <button class="delete-storie">
                    Excluir história
                </button>
            </form>
        </div>
    </div>
        @endif
    @endcan

        @php
        $index = 0;
        @endphp

        <div class="title-chapters">
            <div class="chapters-title">
            <h3 style="font-size: 18pt">
                Capítulos
            </h3>
        

        @forelse ($storie->chapters as $chapter)
        <div class="chapter-list">
            <div class="chapter-selection">
                <h3 style="font-size: 16pt; margin-left: 3em;">{{$index += 1}} | <a href="{{route('chapter.show', $chapter->id)}}" style="color: var(--main-color);">{{$chapter->title}}</a></h3>
                @can('authenticated')
                @if (Auth::id() === $storie->users[0]->id)
                <div class="chapter-crud">
                    <form action="{{ route('chapter.edit', $chapter->id) }}" method="get">
                        <button>
                            Editar
                        </button>
                    </form>
                    <form action="{{ route('chapter.destroy', $chapter->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <button style="background-color: #c03131;">
                            Excluir
                        </button>
                    </form>
                </div>
                @endif
            @endcan
            </div>
        </div>
    @empty
    <div>
        <h3>A história ainda não possui nenhum capítulo. Volte mais tarde!</h3>
    </div>
    </div>
    @endforelse
    </section>
</section>
@endsection