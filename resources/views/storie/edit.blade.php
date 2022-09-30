@extends('layouts.main')

@section('title', 'Editar história: ' .  $storie->title . ' - Touchfic')

@section('content')
<main class="storie-form-container">
<section class="storie-form">
    <h2>
        {{ $storie->title }}
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

    <form action="{{ route('storie.update', $storie->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        <label for="title">Título</label>
        <input type="text" placeholder="Título da sua história" name="title" autofocus value="{{$storie->title}}">

        <label for="agegroup">Faixa etária</label>
        <select name="agegroup">
            @foreach ($agegroups as $agegroup)
                <option value="{{ $agegroup->id }}">{{ $agegroup->agegroup }}</option>
            @endforeach
        </select>

        <label for="cover">Capa</label>
        <img src="{{ asset('storage/images/storie/cover/' . $storie->cover) }}" class="cover-show">
        <input type="file" name="cover">
        <div class="advice-msg">
                <p>
                    Lembre-se, pequeno gafanhoto:<br>
                    O conteúdo da capa <span>obrigatoriamente</span> precisa ser <span>livre para todos os públicos</span>.
                </p>
            </div>

        <label for="synopsis">Sinopse</label>
        <textarea name="synopsis" cols="90" rows="10" placeholder="Escreva uma sinopse para sua história">{{ $storie->synopsis }}</textarea>
        
        <div class="genres">
        <p>Selecione os gêneros que combinam com sua história</p>
        @foreach ($genres as $genre)

            @php
                $listed = false;
            @endphp
            
            @foreach ($storie->genres as $selectGenre)
                @if ($selectGenre->genre === $genre->genre)
                    <label for="{{$genre->genre}}">{{$genre->genre}}</label>
                    <input type="checkbox" name="genres[]" value="{{$genre->id}}" id="{{$genre->genre}}" checked>
                    @php
                        $listed = true;
                    @endphp
                @endif
            @endforeach

            @if (!$listed)
                <label for="{{$genre->genre}}">{{$genre->genre}}</label>
                <input type="checkbox" name="genres[]" value="{{$genre->id}}" id="{{$genre->genre}}">
            @endif

        @endforeach
        </div>

        <div class="container-submit">
            <div class="submit-story-button">
                <button>
                    Enviar alterações
                </button>
            </div>
        </div>
    </form>
</section>
</main>
@endsection