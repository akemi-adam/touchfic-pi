@extends('layouts.main')

@section('title', 'Cargos')

@section('content')
    <h1>
        Cargos no sistema
    </h1>
    <hr>
    <h2>
        Administradores:
    </h2>
    <ul>
        @foreach ($admins as $admin)
            <li>{{$admin->name}}</li>
            <form action="{{ route('admin.permission.change', ['user' => $admin]) }}" method="get">
                <button style="display: inline">Mudar cargo</button>
            </form>
        @endforeach
    </ul>
    <hr>
    <h2>
        Moderadores:
    </h2>
    <ul>
        @foreach ($moderators as $moderator)
            <li>{{$moderator->name}}</li>
            <form action="{{ route('admin.permission.change', ['user' => $moderator]) }}" method="get">
                <button style="display: inline">Mudar cargo</button>
            </form>
        @endforeach
    </ul>
    <form action="{{ route('admin.permission.edit') }}" method="get">
        <button>
            Promova um usuário
        </button>
    </form>
@endsection