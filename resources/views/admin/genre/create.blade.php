@extends('layouts.main')

@section('title', 'Adicionar gênero')

@section('content')
    <h1 class="title">
        Adicione um novo gênero literário
    </h1>
    <div class="container-faq">
        <div class="div-faq">
            <form action="{{route('admin.genre.store')}}" method="post">
                @csrf
                <label for="gender">Novo gênero</label>
                <input type="text" name="genre" placeholder="Exemplo: Sci-fi, Românce, Aventura...">
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