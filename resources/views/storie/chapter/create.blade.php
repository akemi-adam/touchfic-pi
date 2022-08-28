@extends('layouts.main')

@section('title', "$storie->title: Novo capítulo")

@section('content')
    <div class="container-create">
        <h1>
            Novo capítulo
        </h1>
        <div>
            <form action="{{ route('chapter.store', $storie->id) }}" method="post">
                @csrf
                <label for="title" class="label-tag">Título</label>
                <input type="text" name="title" class="input-title" placeholder="Título do capítulo">
                <label for="authornotes" class="label-tag">Notas do autor</label><br>
                <textarea name="authornotes" cols="90" rows="15" class="desc-textearea" placeholder="Algo a dizer sobre o capítulo? Escreva aqui!"></textarea>
                <label for="content">Capítulo</label><br>
                <textarea name="content" cols="90" rows="15" class="desc-textearea" placeholder="Ponha a sua imaginação aqui..."></textarea>
                <div class="container-submit">
                    <div class="submit-story-button">
                        <button>
                            Enviar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
