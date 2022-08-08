<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="https://cdn-icons-png.flaticon.com/512/3629/3629072.png">
    <script src="https://kit.fontawesome.com/f17bb9c677.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/css/style.css">
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Manrope:wght@300&family=Poppins:ital,wght@0,300;0,400;1,300&display=swap');
    </style>

    <title>
        @yield('title')
    </title>

</head>
<body>

    <header>
        <div>
            <a href="/" class="logo"><img src="https://cdn-icons-png.flaticon.com/512/3629/3629072.png" alt="Touchfic">Touchfic</a>
        </div>
        <nav>
            <ul>
                <li><a href="/about" class="nav-link">Sobre</a></li>
                <li><a href="/faq" class="nav-link">FAQ</a></li>
                <li><a href="/login" class="nav-link">Login</a></li>
                <li><a href="/register" class="nav-link">Cadastre-se</a></li>
            </ul>
        </nav>
    </header>

    @yield('content')

    <footer>
        <div>
            <p>Touchfic: crie e leia histórias com um só toque</p>
            <ul>
                <li><a href="/"><i class="fa-brands fa-instagram"></i></a></li>
                <li><a href="/"><i class="fa-brands fa-twitter"></i></a></li>
                <li><a href="/"><i class="fa-brands fa-facebook"></i></a></li>
                <li><a href="/"><i class="fa-brands fa-tiktok"></i></a></li>
                <li><a href="/"><i class="fa-brands fa-pinterest"></i></a></li>
            </ul>
        </div>

        <div>
            <ul>
                <li><a href="/">Termos de Uso</a></li>
                <li><a href="/">Política de Privacidade</a></li>
            </ul>
        </div>

        <div class="div-credits">
            <a href="https://www.flaticon.com/br/icones-gratis/tocha" title="tocha ícones">Tocha ícones criados por Freepik - Flaticon</a>
        </div>
    </footer>
</body>
</html>