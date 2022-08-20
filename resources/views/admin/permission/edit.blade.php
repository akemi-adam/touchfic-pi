@extends('layouts.main')

@section('title', 'Conceder permissão')

@section('content')
    <h2>
        Torne um usuário administrador
    </h2>
    <form action="{{ route('admin.permission.update') }}" method="post">
        @csrf
        @method('put')
        <select name="promoted_user">
            @foreach ($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>
        <div class="">
            <label for="admin">
                Administrador:
            </label>
            <input type="radio" name="promotion" style="display: inline" value="3" id="admin">
            <label for="moderator">
                Moderador
            </label>
            <input type="radio" name="promotion" style="display: inline" value="2" id="moderator" checked>
        </div>
        
        <button>
            Promover
        </button>
    </form>
@endsection