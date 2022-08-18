@extends('layouts.main')

@section('title', "$genre->genre: detalhes")

@section('content')
    <h1>
        {{$genre->genre}}
    </h1>
    <p>
        Data de criação: {{$genre->created_at}} <br> Data de atualização: {{$genre->updated_at}} 
    </p>
@endsection
