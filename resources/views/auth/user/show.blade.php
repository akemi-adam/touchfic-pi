@extends('layouts.main')

@section('title', 'Perfil')

@section('content')
    <img src="/img/user/avatar/{{ $user->avatar }}" class="avatar">
    <h2>
        {{$user->name}}
    </h2>
    <p>
        Email: {{$user->email}} <br>
        Status: {{$user->permission->permission}}
    </p>
    @if ($user->id === Auth::user()->id)
        <form action="{{ route('user.edit', $user->id) }}" method="get">
            <button>
                Editar perfil
            </button>
        </form>
    @endif
@endsection