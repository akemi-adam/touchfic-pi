@extends('layouts.main')

@section('title', 'Resultados da busca: ' . $search . ' - Touchfic')

@section('content')
    <h2 class="title">
        Resultados da busca: "{{ $search }}"
    </h2>

    <div class="stories-card">
    <h3>
        Histórias
    </h3>
    @forelse ($stories as $storie)
    <div class="storie-card">
        <div class="card-info">
        <h3><a href="{{  route('storie.show', $storie->id) }}">{{ $storie->title }}</h3>
        <img src="{{ FileSupport::getCover($storie->cover) }}" class="cover-index"></a>
        <strong>Faixa etária: {{ $storie->agegroup->agegroup }}</strong>
        <strong>Número de palavras: {{ $storie->numberofwords }}</strong>
        <a href="{{ route('user.show', $storie->users[0]->name) }}">{{$storie->name}}</a>
        @php
            $amount = DB::table('likes')->where('storie_id', $storie->id)->count();
        @endphp
        <strong>Número de likes: {{ $amount }}</strong>
        <p>
            {{ $storie->synopsis }}
        </p>
        </div>
    </div>
    <hr>
    @empty
        <h2>
            Nenhuma história encontrada
        </h2>
    @endforelse
    <h3>
        Usuários
    </h3>
    @forelse ($users as $user)
    
    <div class="search-user">
        <a href="{{ route('user.show', $user->id) }}">
        <img src="{{ asset('storage/images/user/avatar/' . $user->avatar) }}" alt="Avatar do usuário" class="avatar">
        </a>

        <div class="search-username">
            <a href="{{ route('user.show', $user->id) }}">{{$user->name}}</a>
        </div>
    </div>
    @empty
        <h2>
            Nenhum usuário encontrado
        </h2>
    @endforelse
</div>
@endsection