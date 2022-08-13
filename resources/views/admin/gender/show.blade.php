@extends('layouts.main')

@section('title', "$gender->gen_gender: detalhes")

@section('content')
    <h1>
        {{$gender->gen_gender}}
    </h1>
    <p>
        Data de criação: {{$gender->created_at}} <br> Data de atualização: {{$gender->updated_at}} 
    </p>
@endsection
