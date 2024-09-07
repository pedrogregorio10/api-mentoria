# MentoriaApi - Tarefa pratica

Este projecto foi desenvolvido como tarefa prática da formação de Backend em laravel com Miguel Almeida, essa API tem como objetivo conectar Mentores e Mentorandos e agendar sessões de mentorias, principais funcionalidades de cadastrar, atualizar, eliminar, buscar, e listar os usuaios da api(Mentores,Metorando).

## Funcionalidades
 
- **Cadastrar usuario**: Perimite Registrar-se como mentor ou mentorando.

- **Atualizar usuario**: Perimite atualizar dados de usuario.

- **Eliminar usuario**: Perimite Remover um usuario da aplicação.

- **Buscar usuario**: Perimite Buscar um determinado usuario pelo seu identificador.

- **Listar usuario**: Perimite listar todos os usuarios da aplicação.

## Requisitos
- PHP 8.2.x ou superior
- Composer

## Instalação

1. Clone Repositorio:

    git clone https://github.com/pedrogregorio10/api-mentoria.git

2. Instale Dependencia

    composer install

3. Pode remover o historico de versionamento(Opcional)
    rm -rf .git

4. Crie e configure o arquivo `.env`: Configure de acordo a base de dados e a porta que estiver usando

    cp .env.example .env

5. Comando para gerar chave no arquivo `.env`:

    php artisan key:generate

6. Iniciar o servidor

    php artisan serve

7. Criar o arquivo de rotas para a API caso não exista
     php artisan install:api

### Listar Usuarios

- **Método**: GET
- **Rota**: `/api/users`
- **Descrição**: Retorna todos os usuarios.

### Buscar Usuario

- **Método**: GET
- **Rota**: `/api/users/{id}`
- **Descrição**: Retorna o usuario com o id informado no parametro.

### Atualizar dados de Usuarios

- **Método**: PATCH
- **Rota**: `/api/users/{id}`
- **Descrição**: Atualiza o usuario com o id passado no parametro e retorna os dados desse usuario atualizado.

### Remover Usuarios

- **Método**: DELETE
- **Rota**: `/api/users/{id}`
- **Descrição**: Remove o usuario com o id no parametro da base de dados.
