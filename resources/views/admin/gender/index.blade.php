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