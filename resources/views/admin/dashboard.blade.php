@extends('layouts.main')

@section('title', 'Opções de administrador')

@section('content')
    <h1 class="title">
        Opções de administrador
    </h1>
    <div class="container-options">
        <div class="div-options">
            <ul>
                <li>
                    <a href="{{route('admin.genre.create')}}">Registrar novo gênero literário</a>
                </li>
                <li>
                    <a href="{{route('admin.genre.index')}}">Visualizar todos os gêneros</a>
                </li>
            </ul>
        </div>
    </div>
@endsection