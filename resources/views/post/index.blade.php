@extends('layouts.main')

@section('title', 'Postagens')
    
@section('content')
    <div class="container-posts">
        <div class="div-posts">
            <h3>
                Postagens
            </h3>
            @foreach ($posts as $post)
                <p>
                    {{ $post->content }}
                    @foreach ($users as $user)
                        @if ($post->user_id === $user->id)
                            <br>
                            <strong>{{ $user->name }}</strong>
                        @endif
                    @endforeach
                </p>
            @endforeach
            <a href="{{ route('post.create') }}" class="post-button">
                <i class="fa-solid fa-circle-plus"></i> Crie uma postagem
            </a>
        </div>
    </div>
@endsection