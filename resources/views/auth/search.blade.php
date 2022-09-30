@extends('layouts.main')

@section('title', 'Resultados da busca: ' . $search . ' - Touchfic')

@section('content')
    <h2>
        Resultados da pesquisa: "{{ $search }}"
    </h2>
    <h3>
        Histórias
    </h3>
    @forelse ($stories as $storie)
        <h3><a href="{{  route('storie.show', $storie->id) }}">{{ $storie->title }}</a></h3>
        <img src="{{ FileSupport::getCover($storie->cover) }}" class="cover-index"><br>
        <strong>Faixa etária: {{ $storie->agegroup->agegroup }}</strong><br>
        <strong>Número de palavras: {{ $storie->numberofwords }}</strong><br>
        <a href="{{ route('user.show', $storie->users[0]->name) }}">{{$storie->name}}</a>
        @php
            $amount = DB::table('likes')->where('storie_id', $storie->id)->count();
        @endphp
        <strong>Número de likes: {{ $amount }}</strong>
        <p>
            {{ $storie->synopsis }}
        </p>
        <hr>
    @empty
        <h2>
            Nenhuma história foi encontrada
        </h2>
    @endforelse
    <h3>
        Usuários
    </h3>
    @forelse ($users as $user)
        <img src="{{ asset('storage/images/user/avatar/' . $user->avatar) }}" alt="Avatar do usuário" class="avatar">
        <h3><a href="{{ route('user.show', $user->id) }}">{{$user->name}}</a></h3>
    @empty
        <h2>
            Nenhum usuário foi encontrado
        </h2>
    @endforelse
@endsection