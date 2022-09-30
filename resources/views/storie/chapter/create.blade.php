@extends('layouts.main')

@section('title', "$storie->title: Novo capítulo - Touchfic")

@section('content')
<main class="storie-form-container">
    <section class="storie-form">
        <h2>
            Novo capítulo
        </h2>
        <div>

            {{-- Error messages --}}
            @if ($errors->any())
                <div>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('chapter.store', $storie->id) }}" method="post">
                @csrf
                <label for="title" class="label-tag">Título</label>
                <input type="text" name="title" class="input-title" placeholder="Título do capítulo" autofocus>

                <label for="authornotes" class="label-tag">Notas do autor (opcional)</label>
                <textarea name="authornotes" cols="90" rows="10" class="desc-textearea" placeholder="Tem algo a dizer sobre o capítulo? Escreva aqui!"></textarea>

                <label for="content">Capítulo</label>
                <textarea name="content" cols="90" rows="15" class="desc-textearea" placeholder="Ponha a sua imaginação aqui..."></textarea>

                @livewire('track-search')
                
                <div class="container-submit">
                    <div class="submit-story-button">
                        <button>
                            Enviar capítulo
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</main>
@endsection
