@extends('layouts.main')

@section('title', "Editar: $genre->genre")

@section('content')
    <h2>
        Edição de gênero
    </h2>
    <div class="container-faq">
        <div class="div-faq">
            <form action="{{route('admin.genre.update', $genre->id)}}" method="post">
                @csrf
                @method('put')
                <label for="gender">Gênero</label>
                <input type="text" name="genre" placeholder="Edite o gênero" value="{{$genre->genre}}">
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