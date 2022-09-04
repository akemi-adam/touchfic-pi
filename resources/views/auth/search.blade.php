@extends('layouts.main')

@section('title', 'Bem-vindo!')

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
        <hr>
    @empty
        <h2>
            Nenhuma história foi encontrada
        </h2>
    @endforelse
    @forelse ($users as $user)
        <img src="/img/user/avatar/{{ $user->avatar }}" alt="Avatar do usuário" class="avatar">
        <h3><a href="{{ route('user.show', $user->id) }}">{{$user->name}}</a></h3>
    @empty
        <h2>
            Nenhum usuário foi encontrado
        </h2>
    @endforelse
@endsection