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
Após ter feito a configuração necessária, rode as migrações com `php artisan migrate`

## Comandos

Em seguida, para popular o banco com algumas informações básicas e essências, rode o comando `php artisan serve:seed --admin`. O comando serve:seed irá popular o banco com essas informações necessárias, enquanto que a option `--admin` irá chamar o comando `make:admin` que cria um usuário administrador.


Ou os seguintes comandos:

```
php artisan make:admin
php artisan db:seed
php artisan serve
```

Com isso, o projeto já estará efetivo para uso.