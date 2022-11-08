@extends('layouts.main')

@section('title', 'Crie uma postagem!')

@section('content')
<div class="container-title">
    <h1 class="title">
        Publicar postagem
    </h1>
    </div>
    <div class="container-textarea">
        <div class="div-textarea">
            <form action="{{ route('post.store') }}" method="post">
                @csrf
                <textarea name="content" id="content" cols="60" rows="10" placeholder="No que você está pensando?" autofocus></textarea>
                <div class="container-submit">
                    <button class="submit-button">
                        Publicar
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection