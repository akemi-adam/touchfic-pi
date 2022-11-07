@extends('layouts.main')

@section('title', 'Editar postagem')

@section('content')
    <h2 class="title">
        Editar postagem
    </h2>
        <div class="container-textarea">
            <div class="div-textarea">
                <form action="{{ route('post.update', $post->id) }}" method="post">
                    @csrf
                    @method('put')
                    <textarea style="margin: 0 auto" name="content" id="content" cols="60" rows="10" placeholder="No que você está pensando?" autofocus>{{ $post->content }}</textarea>
                    <div class="container-submit">
                        <button class="submit-button">
                            Enviar alterações
                        </button>
                    </div>
                </form>
            </div>
        </div>
@endsection