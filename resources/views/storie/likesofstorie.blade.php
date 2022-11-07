@extends('layouts.main')

@section('title', 'Curtidas da história - Touchfic')

@section('content')

    <h2 class="title">
        Todas as curtidas
    </h2>

    @forelse ($users as $user)
    <div class="list-likes-container">
    <a href="{{ route('user.show', $user->id) }}">
        <div>
            <img src="{{ FileSupport::getAvatar($user->avatar) }}" alt="Foto de perfil de {{ $user->name }}" class="avatar">
            {{ $user->name }}
        </div>
    </a>
    </div>

    @empty
    <div class="central-msg-container">
        <h2 class="central-msg">
            A história ainda não possui nenhuma curtida
        </h2>
    </div>
    @endforelse
@endsection