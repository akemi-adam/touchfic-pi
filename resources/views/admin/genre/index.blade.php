@extends('layouts.main')

@section('title', 'Gêneros')

@section('content')
    <h1 class="title">
        Todos os gêneros
    </h1>
    <div class="container-options">
        <div class="div-options">
            <ul>
                @foreach ($genres as $genre)
                    @if ($genre->visible ===  1)
                        <h1>
                            Configurar posteriormente
                        </h1>
                    @else
                        <li>
                            <a href="{{route('admin.genre.show' , $genre->id)}}" style="color: #3f1651">{{$genre->genre}}</a>
                        </li>
                        <form action="{{route('admin.genre.destroy', $genre->id)}}" method="post">
                            @csrf
                            @method('delete')
                            <button style="background-color: rgb(192, 49, 49); color: white; font-size: 12pt; font-family: Franklin Gothic Medium; border-radius: 7px; border: none; padding: 5px; font-weight: bold;">
                                Remover
                            </button>
                        </form>
                        <form action="{{ route('admin.genre.edit', $genre->id) }}" method="get">
                            <button style="background-color: rgb(77, 129, 235); color: white; font-size: 12pt; font-family: Franklin Gothic Medium; border-radius: 7px; border: none; padding: 5px; font-weight: bold;">Editar</button>
                        </form>
                    @endif
                @endforeach
            </ul>
            <button class="genre-button">
                <a href="{{route('admin.genre.create')}}" style="color: white">
                    Adicionar novo gênero
                </a>
            </button>
        </div>
    </div>
@endsection