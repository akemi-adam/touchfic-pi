@extends('layouts.main')

@section('title', 'Histórias - Touchfic')

@section('content')

<div class="stories-card">
    @forelse ($stories as $storie)
    <div class="storie-card">
        <h3><a href="{{  route('storie.show', $storie->id) }}">{{ $storie->title }}</h3>
        <img src="{{ FileSupport::getCover($storie->cover) }}" class="cover-index"></a>

        <div class="card-info">
            <strong>Faixa etária: {{ $storie->agegroup->agegroup }}</strong>
            <strong>Número de palavras: {{ $storie->numberofwords }}</strong>
            @php
                $amount = DB::table('likes')->where('storie_id', $storie->id)->count();
            @endphp
            <strong>Curtidas: {{ $amount }}</strong>
            Escrita por: <a href="{{ route('user.show', $storie->users[0]->id) }}">{{$storie->users[0]->name}}</a>
        </div>

        <p>
            {{ $storie->synopsis }}
        </p>

        <div class="storie-crud">
            @if (Auth::id() === $storie->users[0]->id)
                <form action="{{ route('storie.edit', $storie->id) }}" method="get">
                    <button class="edit-storie">
                        Editar
                    </button>
                </form>
                <form action="{{ route('storie.destroy', $storie->id) }}" method="post">
                    @csrf
                    @method('delete')
                    <button class="delete-storie">
                        Excluir
                    </button>
                </form>
            @endif
        </div>
</div>
        <hr>
    @empty
        <h2>Nenhuma história foi publicada ainda</h2>
    @endforelse
</div>
@endsection