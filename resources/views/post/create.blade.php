@extends('layouts.main')

@section('title', 'Crie uma postagem!')

@section('content')
    <h1 class="title">
        Publique uma postagem!
    </h1>

    <div class="container-textarea">
        <div class="div-textarea">
            <form action="/posts/register" method="post">
                <textarea name="content" id="content" cols="60" rows="10" placeholder="No que você está pensando?" autofocus></textarea>
                <div class="container-submit">
                    <button class="submit-button">
                        Enviar
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection