@extends('layouts.main')

@section('title', 'Touchfic: crie e leia histórias com um só toque!')

@section('content')
    <div class="banner">
        <h1>O Touchfic é o site ideal para aqueles que desejam mergulhar e participar de um mundo repleto de histórias cativantes.</h1>
        <h2><a href="{{ route('register') }}">Cadastre-se grátis!</a></h2>
        <br>
    </div>
@endsection