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


Após ter feito a configuração necessária, rode as migrações com `php artisan migrate`

## File Storage

Depois disso, é preciso usar o comando `php artisan storage:link` para linkar a pasta storage que armazena os arquivos de imagem do projeto com a pasta public. Além disso, é necessário que dentro de `storage/app/public` exista a seguinte hierarquia de diretórios:

- images
  - storie
     - cover
  - user
     - avatar

Será necessário também que dentro de cover e de avatar existam arquivos default com os seguintes nomes, respectivamente: `default-storie_cover.png` e `default-user-avatar.png`

## Comandos

Em seguida, para popular o banco com algumas informações básicas e essências, rode o comando `php artisan serve:seed`. O comando serve:seed irá popular o banco com essas informações necessárias e criar um usuário administrador caso necessário.

Ou os seguintes comandos:

```
php artisan make:admin
php artisan db:seed
php artisan serve
```

Com isso, o projeto já estará efetivo para uso.