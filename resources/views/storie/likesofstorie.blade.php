@extends('layouts.main')

@section('title', "Curtidas da história")

@section('content')
    @forelse ($users as $user)
        <div>
            <img src="{{ FileSupport::getAvatar($user->avatar) }}" alt="Foto de perfil de {{ $user->name }}" class="avatar">
            <a href="{{ route('user.show', $user->id) }}">{{ $user->name }}</a>
        </div>
        <hr>
    @empty
        <h2>
            A história não possui nenhum like ainda
        </h2>
    @endforelse
@endsection