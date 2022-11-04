@extends('layouts.main')

@section('title', 'Perfil de ' . $user->name . ' - Touchfic')

@section('content')
<section class="profile-container">
    <div class="profile-user">
        <img src="{{ FileSupport::getAvatar($user->avatar) }}" class="avatar">
        <h2>
            {{$user->name}}
        </h2>

        <span>
        @if ($user->id === Auth::user()->id)
            <strong>E-mail:</strong> {{$user->email}}
        @endif
        </span>

        <span>
            <strong>Status:</strong> {{$user->permission->permission}}
        </span>
    </div>

    <div class="profile-biography">
        <h3>
            Biografia
        </h3>
        @if (!is_null($user->biography))
            <p>
                {{ $user->biography }}
            </p>
        @endif

        @if ($user->id === Auth::user()->id)
            <form action="{{ route('user.edit', $user->id) }}" method="get">
                <button>
                <i class="fa-solid fa-pen-to-square"></i> Editar perfil
                </button>
            </form>
        @endif
    </div>

    <div class="profile-stories">
        <h3>
            <a href="{{ route('storie.mystories', $user) }}">
                Ver histórias de {{$user->name}} <i class="fa-solid fa-arrow-right"></i>
            </a>
        </h3>
    </div>

</section>
@endsection