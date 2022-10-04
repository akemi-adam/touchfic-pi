@extends('layouts.main')

@section('title', 'Conceder permissão')

@section('content')
    <h1>
        Alterar cargo de {{$user->name}}
    </h1>
    <form action="{{ route('admin.permission.transference', $user->id) }}" method="post">
        @csrf
        @method('put')
        <select name="permission_id">
            @foreach ($permissions as $permission)
                <option value="{{$permission->id}}">{{$permission->permission}}</option>
            @endforeach
        </select>
        <button>
            Mudar cargo
        </button>
    </form>
@endsection