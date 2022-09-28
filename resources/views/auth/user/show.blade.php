@extends('layouts.main')

@section('title', 'Perfil')

@section('content')
    <img src="{{ asset('storage/images/user/avatar/' . $user->avatar)}}" class="avatar">
    <h2>
        {{$user->name}}
    </h2>
    <p>
        Email: {{$user->email}} <br>
        Status: {{$user->permission->permission}}
    </p>
    @if (!is_null($user->biography))
        <p>
            {{ $user->biography }}
        </p>
    @endif
    @if ($user->id === Auth::user()->id)
        <form action="{{ route('user.edit', $user->id) }}" method="get">
            <button>
                Editar perfil
            </button>
        </form>
    @endif
    <hr>
    <h3>
        <a href="{{ route('storie.mystories', $user->id) }}">
            Histórias do usuário
        </a>
    </h3>
@endsection