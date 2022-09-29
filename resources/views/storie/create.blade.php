@extends('layouts.main')

@section('title', 'Criar uma história - Touchfic')

@section('content')
<main class="storie-form-container">
<section class="storie-form">
    <h2>
        Criar uma história
    </h2>

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

    <form action="{{ route('storie.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <label for="title">Título</label>
        <input type="text" placeholder="Título da sua história" name="title" autofocus>

        <label for="cover">Capa</label>
        <input type="file" name="cover">
        <div class="advice-msg">
                <p>
                    Adicionar uma capa à sua história tende a chamar a atenção dos leitores no site.<br>
                    O conteúdo da capa <span>obrigatoriamente</span> precisa ser <span>livre para todos os públicos</span>.
                </p>
            </div>

        <label for="agegroup">Faixa etária</label>
        <select name="agegroup">
            @foreach ($agegroups as $agegroup)
                <option value="{{ $agegroup->id }}">{{ $agegroup->agegroup }}</option>
            @endforeach
        </select>

        <label for="synopsis">Sinopse</label>
        <textarea name="synopsis" cols="90" rows="15" placeholder="Escreva uma sinopse para sua história..."></textarea>

        <div class="genres">
        <p>Selecione os gêneros que combinam com sua história</p>
        @foreach ($genres as $genre)
            <label for="{{$genre->genre}}">{{$genre->genre}}</label>
            <input type="checkbox" name="genres[]" value="{{$genre->id}}" id="{{$genre->genre}}">
        @endforeach
        </div>

        <div class="container-submit">
            <div class="submit-story-button">
                <button>
                    Enviar
                </button>
            </div>
        </div>
    </form>
</section>
</main>
@endsection