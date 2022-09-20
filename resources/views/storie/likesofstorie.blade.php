@extends('layouts.main')

@section('title', "Curtidas da história")

@section('content')
<article class="site-content">
    @forelse ($datas as $item)
        <div>
            <img src="{{ asset('storage/images/user/avatar/' . $item->avatar) }}" alt="Foto de perfil de {{ $item->name }}" class="avatar">
            <a href="{{ route('user.show', $item->user_id) }}">{{ $item->name }}</a>
        </div>
        <hr>
    @empty
        <h2>
            A história não possui nenhum like ainda
        </h2>
    @endforelse
</article>
@endsection