@extends('layouts.main')

@section('title', 'Editar capítulo: ' . $chapter->title)

@section('content')
    <div class="container-create">
        <h1>
            {{ $chapter->title }}
        </h1>
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

            <form action="{{ route('chapter.update', $chapter->id) }}" method="post">
                @csrf
                @method('put')
                <label for="title" class="label-tag">Título</label>
                <input type="text" name="title" class="input-title" placeholder="Título do capítulo" value="{{$chapter->title}}">
                <label for="authornotes" class="label-tag">Notas do autor</label><br>
                <textarea name="authornotes" cols="90" rows="15" class="desc-textearea" placeholder="Algo a dizer sobre o capítulo? Escreva aqui!">{{$chapter->authornotes}}</textarea>
                <label for="content">Capítulo</label><br>
                <textarea name="content" cols="90" rows="15" class="desc-textearea" placeholder="Ponha a sua imaginação aqui...">{{$chapter->content}}</textarea>
                @livewire('track-search')
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