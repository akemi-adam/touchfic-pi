@extends('layouts.main')

@section('title', 'Minhas histórias')

@section('content')
    @forelse ($stories as $storie)
        <h3><a href="{{  route('storie.show', $storie->storie_id) }}">{{ $storie->title }}</a></h3>
        <img src="/img/storie/cover/{{ $storie->cover }}" class="cover-index">
        <strong>Faixa etária: {{ $storie->agegroup->agegroup }}</strong><br>
        <strong>Número de palavras: {{ $storie->numberofwords }}</strong><br>
        <a href="{{ route('user.show', $storie->user_id) }}">{{$storie->name}}</a>
        {{-- <strong>Número de likes: </strong> --}}
        <p>
            {{ $storie->synopsis }}
        </p>
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
        <hr>
    @empty
        <h2>Não há nenhuma história por aqui</h2>
    @endforelse
    <form action="{{ route('storie.create') }}" method="get">
        <button>
            Criar uma história
        </button>
    </form>
@endsection