<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Ícones --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <script src="https://kit.fontawesome.com/f17bb9c677.js" crossorigin="anonymous"></script>
    
    {{-- CSS da Aplicação --}}
    <link rel="stylesheet" href="/css/style.css">

    {{-- Seção de Título --}}
    <title>
        @yield('title')
    </title>

    {{-- Seção para JavaScript --}}
        @yield('scripts')
    <script src="/js/year.js"></script>

    {{-- Livewire --}}
    @livewireStyles
</head>
<body>

    {{-- Header --}}
    @include('layouts.partials.header')

    {{-- Flash Message --}}
    @include('layouts.partials.messages')

    {{-- Side Bar --}}
    @include('layouts.partials.sidebar')
    
    {{-- Seção do Conteúdo --}}
    <article class="site-content">
        @yield('content')
    </article>
    

    {{-- Footer --}}
    @include('layouts.partials.footer')

    {{-- Livewire --}}
    @livewireScripts
</body>
</html>