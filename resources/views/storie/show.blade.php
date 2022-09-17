@extends('layouts.main')

@section('title', $storie->title)

@section('scripts')
    <script src="/js/amountlikes.js" defer></script>
@endsection

@section('content')
<article class="site-content">

<section class="storie-info-container">
    <section class="storie-info">
    <div class="storie-title-container">
        <h2 class="storie-title">
            {{ $storie->title }}
        </h2>
    </div>
    <img src="{{ asset('storage/images/storie/cover/' . $storie->cover) }}" class="cover-show">
    
    <div class="storie-data-1">
    <p>Escrita por: <a href="{{ route('user.show', $storie->user_id) }}">{{ $storie->name }}</a></p>
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
        <strong><a href="{{route('likes.of.storie', $storie->storie_id)}}" id="likes" value="{{ $amount }}">Curtidas: {{ $amount }}</a></strong>
    

    @can('authenticated')
        @livewire('like', ['storieId' => $storie->storie_id, 'authorId' => $storie->user_id])
    @endcan
    </div>

    <span>Gêneros:</span>
    <ul>
        @foreach ($genres as $genre)
            <li style="color: #262626">{{$genre->genre}}</li> 
        @endforeach
    </ul>
<h4>Sinopse:</h4>
    <p>{!!nl2br(e($storie->synopsis))!!}</p>
    @can('authenticated')
        @if (Auth::user()->id === $storie->user_id)
            <form action="{{ route('storie.edit', $storie->storie_id) }}" method="get">
                <button>
                    Editar
                </button>
            </form>
            <form action="{{ route('storie.destroy', $storie->storie_id) }}" method="post">
                @csrf
                @method('delete')
                <button>
                    Deletar
                </button>
            </form>
            <form action="{{ route('chapter.create', $storie->storie_id) }}" method="get">
                <button>Adicionar um capítulo</button>
            </form>
    </div>
        @endif
    @endcan
    <hr>
    <h3>
        Capítulos
    </h3>
    @php
        $index = 0;
    @endphp
    @forelse ($chapters as $chapter)
        <div>
            <h3>{{$index += 1}} | <a style="text-decoration: none" href="{{route('chapter.show', $chapter->id)}}">{{$chapter->title}}</a> </h3>
            @can('authenticated')
                @if (Auth::user()->id === $storie->user_id)
                    <form action="{{ route('chapter.edit', $chapter->id) }}" method="get">
                        <button style="background-color: rgb(112, 144, 250); border:1px solid black">
                            Editar
                        </button>
                    </form>
                    <form action="{{ route('chapter.destroy', $chapter->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <button style="background-color:rgb(255, 98, 98); border:1px solid black">
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

</article>
@endsection