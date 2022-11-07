@extends('layouts.main')

@section('title', 'Touchfic: crie, leia histórias e turbine sua imaginação!')

@section('content')

<section class="welcome-content">

<div class="welcome-container">
    <div class="welcome-image">
        <img src="/images/template/welcome.svg" alt="Boas-vindas ao Touchfic!">
    </div>

    <div class="welcome-info">

        <h1>Boas-vindas ao Touchfic!</h1>
        <p>Comece sua jornada de leitura e compartilhe suas fanfics ou 
        histórias originais com uma conta no Touchfic!</p>

        <div class="auth-buttons">
            <a href="{{ route('register') }}">Cadastre-se grátis</a>
            <a href="{{ route('login') }}">Fazer login</a>
        </div>

    </div>
</div>
</section>
@endsection