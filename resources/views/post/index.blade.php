@extends('layouts.main')

@section('title', 'Postagens')
    
@section('content')
    <div class="container-posts">
        <div class="div-posts">
            <h3>
                Postagens
            </h3>
            <a href="{{ route('post.create') }}" class="post-button">
                <i class="fa-solid fa-circle-plus"></i> Crie uma postagem
            </a>
        </div>
    </div>
@endsection