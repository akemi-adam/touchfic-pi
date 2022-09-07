@extends('layouts.main')

@section('title', 'Dúvidas frequentes')

@section('content')
    <div class="container-title">
        <h1 class="title">
            FAQ - Perguntas frequentes
        </h1>
    </div>
    <div class="container-faq">
        <div class="div-faq">
            <h3><span>1. Por que o Touchfic é representado por uma tocha acesa?</span></h3>
            <p>A verdade é que "Touch", de acordo com um de nossos desenvolvedores, é semelhante à palavra "Tocha". Acabamos aderindo a ideia, no final das contas.</p>
        </div>
        <div class="div-faq">
            <h3><span>2. Como publico as minhas histórias?</span></h3>
            <p>Para publicar uma história no Touchfic, você deve ter uma conta no site e inciar sua sessão em <a href="/login" target="_blank">Login</a> (caso não possua uma conta, <a href="/register" target="_blank">clique aqui</a> para se registrar).</p>
            <p>Ao iniciar sua sessão, você irá se deparar com um menu repleto de opções. Clique em <strong>Criar uma história</strong> para prosseguir. Agora, é só adicionar título, descrição, faixa etária (<strong>lembre-se de selecionar cuidadosamente esta opção</strong>) e gênero.</p>
            <p>Pronto! Sua história vai estar publicada na plataforma do Touchfic no mesmo instante!</p>
        </div>
        <div class="div-faq">
            <h3><span>3. Como adiciono capítulos nas minhas histórias?</span></h3>
            <p>Para adicionar um capítulo a qualquer uma de suas histórias, é preciso, após ter seguido os passos do <strong>Item 2</strong>, acessar a página <strong>Minhas histórias</strong> no menu de opções do usuário. Em seguida, selecione "Visualizar" na história que você desejar, e depois "Criar capítulo". Adicione o conteúdo necessário, envie e pronto! O capítulo já está disponível para leitura instantaneamente.</p>
        </div>
        <div class="div-faq">
            <h3><span>4. Quero excluir minha história do Touchfic. Como faço isso?</span></h3>
            <p>Por mais triste que isso pareça (ou não), basta acessar <strong>Minhas histórias</strong> no menu do usuário, clicar em "Visualizar" na história que desejar, e depois clicar em "Excluir". Tenha em mente que esta ação é <strong>irreversível</strong> e não será possível restaurar <strong>nenhum</strong> dado relacionado a história.</p>
        </div>
    </div>
@endsection
