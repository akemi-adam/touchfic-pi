@extends('layouts.main')

@section('title', 'Histórias')

@section('content')
    @forelse ($stories as $storie)
        <h3><a href="{{  route('storie.show', $storie->id) }}">{{ $storie->title }}</a></h3>
        <img src="{{ asset('storage/images/storie/cover/' . $storie->cover) }}" class="cover-index">
        <strong>Faixa etária: {{ $storie->agegroup->agegroup }}</strong><br>
        <strong>Número de palavras: {{ $storie->numberofwords }}</strong><br>
        @php
            $amount = DB::table('likes')->where('storie_id', $storie->id)->count();
        @endphp
        <strong>Número de likes: {{ $amount }}</strong>
        <a href="{{ route('user.show', $storie->users[0]->id) }}">{{$storie->users[0]->name}}</a>
        <p>
            {{ $storie->synopsis }}
        </p>
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
        @endif
        <hr>
    @empty
        <h2>Nenhuma história foi publicada ainda</h2>
    @endforelse
    <form action="{{ route('storie.create') }}" method="get">
        <button>
            Criar uma história
        </button>
    </form>
@endsection