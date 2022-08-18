@extends('layouts.main')

@section('title', 'Bem-vindo!')

@section('content')
    <div class="container-title">
        <h1 class="title">
            <mark>Olá, seja bem-vindo</mark>
        </h1>
        <h2 class="subtitle">
            Boas-vindas! Selecione a opção de sua preferência
        </h2>
    </div>
    <div class="container-faq">
        <div class="div-faq">
            <p><i class="fa-solid fa-book"></i><strong> Não tem ideia do que ler? Consulte a lista das histórias mais recentes!</strong></p>
            <a href="#">Visualizar histórias <i class="fa-solid fa-arrow-right"></i></a>
        </div>
        <div class="div-faq">
            <p><i class="fa-solid fa-circle-plus"></i><strong> Crie sua história e mostre sua criatividade ao mundo!</strong></p>
            <a href="#">Criar uma história <i class="fa-solid fa-arrow-right"></i></a>
        </div>
        <div class="div-faq">
            <p><i class="fa-solid fa-book-open-reader"></i><strong> Vizualize e gerencie as histórias que você criou!</strong></p>
            <a href="#">Minhas histórias <i class="fa-solid fa-arrow-right"></i></a>
        </div>
        <div class="div-faq">
            <p><i class="fa-solid fa-message"></i><strong> Fique por dentro das postagens mais recentes da plataforma!</strong></p>
            <a href="{{ route('post.index') }}">Ver todas as postagens <i class="fa-solid fa-arrow-right"></i></a>
        </div>
        <div class="div-faq">
            <p><i class="fa-solid fa-share-from-square"></i><strong> Compartilhe uma postagem sobre você ou sobre uma história que te empolga!</strong></p>
            <a href="{{ route('post.create') }}">Publicar uma postagem <i class="fa-solid fa-arrow-right"></i></a>
        </div>
        <div class="div-faq">
            <p><i class="fa-solid fa-gear"></i><strong> Opções de administrador (Restrito)</strong></p>
            <a href="{{ route('admin.dashboard') }}">Acesso do administrador <i class="fa-solid fa-arrow-right"></i></a>
        </div>
    </div>
    <div class="container-logout">
        <form action="{{route('logout')}}" method="post">
            @csrf
            <button>
                Sair
            </button>
        </form>
    </div>
@endsection