# Touchfic

O touchfic é um site, desenvolvido para o projeto integrador das disciplinas técnicas do curso de Informática para Internet do IFRN campus Caicó. O projeto é um sistema completo de registro de histórias online; desde de postagens, histórias, capítulos, comentários e etc.

A aplicação foi desenvolvida em php, utilizando php utilizando Laravel.


# Como instalar

Para instalar o sistema, é preciso clonar o repositório em um diretório de sua preferência e atualizar o projeto com: `composer update`.

## Banco de dados

Na raiz do projeto, existe um arquivo .env.example. O renomeie ou crie um arquivo chamado .env e copie tudo do example para ele. Uma vez tendo feito uma das duas formas, é necessário agora configurar as seguintes variáveis:

```
DB_CONNECTION=<tipo do banco usado>
DB_HOST=<host>
DB_PORT=<porta>
DB_DATABASE=<nome do banco>
DB_USERNAME=<usuário>
DB_PASSWORD=<senha>
```

## Mail Service

Além de configurar a conexão com o banco de dados, é preciso configurar o serviço de email:
```
MAIL_HOST=<host>
MAIL_PORT=<porta>
MAIL_USERNAME=<username>
MAIL_PASSWORD=<senha>
MAIL_ENCRYPTION=<encryption>
MAIL_FROM_ADDRESS=<remetente>
```
Para fins de desenvolvimento, a aplicação está utilizando o <a href="https://mailtrap.io/">mailtrap</a>.

## Spotify

Uma vez que a aplicação consta com uma integração com o Spotify, é preciso configurar as chaves da sua aplicação do Spotify no .env
```
SPOTIFY_CLIENT_ID=<id do cliente>
SPOTIFY_CLIENT_SECRET=<chave secreta>
```

## Google

A aplicação contempla o recurso de autenticação pelo google utilizando o Socialite. Para isso, é preciso preencher os seguintes campos no arquivo .env:

```
GOOGLE_CLIENT_ID=<id do client>
GOOGLE_CLIENT_SECRET=<chave secreta>
```

Após ter feito a configuração necessária, rode as migrações com `php artisan migrate`

## File Storage

Depois disso, é preciso usar o comando `php artisan storage:link` para linkar a pasta storage que armazena os arquivos de imagem do projeto com a pasta public. Além disso, é necessário que dentro de `storage/app/public` exista a seguinte hierarquia de diretórios:

- images
  - storie
     - cover
  - user
     - avatar

## Comandos

Em seguida, para popular o banco com algumas informações básicas e essências, rode o comando `php artisan db:seed`. Após isso, crie um usuário administrador pelo CLI com o comando `php artisan make:seed`. Por fim, inicie o servidor com `php artisan serve`.

Ordem dos comandos:

```
php artisan db:seed
php artisan make:admin
php artisan serve
```

Com isso, o projeto já estará efetivo para uso.