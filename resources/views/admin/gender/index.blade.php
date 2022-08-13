@extends('layouts.main')

@section('title', 'Gêneros')

@section('content')
    <h1 class="title">
        Todos os gêneros
    </h1>
    <div class="container-options">
        <div class="div-options">
            <ul>
                @foreach ($genders as $gender)
                    @if ($gender->gen_visible ==  1)
                        <li>
                            {{$gender->gen_gender}}
                        </li>
                        <form action="{{route('admin.gender.destroy', $gender->gen_id)}}" method="post">
                            @csrf
                            @method('delete')
                            <button style="background-color: rgb(192, 49, 49); color: white; font-size: 12pt; font-family: Franklin Gothic Medium; border-radius: 7px; border: none; padding: 5px; font-weight: bold;">
                                Remover
                            </button>
                        </form>
                    @endif
                @endforeach
            </ul>
            <button class="genre-button">
                <a href="{{route('admin.gender.create')}}" style="color: white">
                    Adicionar novo gênero
                </a>
            </button>
        </div>
    </div>
@endsection