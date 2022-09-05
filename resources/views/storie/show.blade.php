@extends('layouts.main')

@section('title', 'História show')

@section('scripts')
    <script src="/js/amountlikes.js" defer></script>
@endsection

@section('content')
    <h2>
        {{ $storie->title }}
    </h2>
    <img src="{{ asset('storage/images/storie/cover/' . $storie->cover) }}" class="cover-show"><br>
    <a href="{{ route('user.show', $storie->user_id) }}">{{ $storie->name }}</a><br>
    <span>Faixa etária: {{ $storie->agegroup->agegroup }}</span><br>
    <span>Número de palavras: {{ $storie->numberofwords }}</span><br>
    <span>Data: </span>
    <small>
        @if ($storie->created_at === $storie->updated_at)
            {{ $storie->created_at }}
        @else
            {{ $storie->updated_at }}
        @endif
    </small><br>
    <strong id="likes" value="{{ $amount }}">Curtidas: {{ $amount }}</strong><br>
    @livewire('like', ['storieId' => $storie->storie_id])
    <span>Gêneros:</span>
    <ul>
        @foreach ($genres as $genre)
            <li style="color:rgb(87, 87, 87)">{{$genre->genre}}</li> 
        @endforeach
    </ul>
<h4>Sinopse:</h4>
    <p>{!!nl2br(e($storie->synopsis))!!}</p>
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
    @endif
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
            
        </div>
    @empty
        <h2>A história não possui nenhum capítulo</h2>
    @endforelse
@endsection