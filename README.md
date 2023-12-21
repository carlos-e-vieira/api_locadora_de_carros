# Locadora de Carros - Backend (v1)
Projeto de teste - backend da aplicação Locadora de Carros.

## Configurando Ambiente de Desenvolvimento

### Configurar o .ENV
Criar uma cópia do .env.exemple e renomear para .env

cp .env.example .env

### Banco de Dados
#### Banco Local
Altere os valores das variáveis de ambiente de # - Conexão Banco Local.
A cópia da base de dados está na pasta .ARQUIVOS

### Rodar o Composer
sudo composer install

### Rodar a API
php artisan serve

### Rodar as Migrations
php artisan migrate

### Rodar as Seeders
php artisan db:seed

## Autenticação do Sistema

### Importar Collection
Importe o arquivo .ARQUIVOS/Collection_Postman.json que está na raiz do projeto.

### Gerar Token
Na collection do postman, acesse o endpoint /login dentro da pasta Autenticação para gerar o token.
No body da request está as credenciais que foram geradas na seeders.
Caso você queira criar um usuário para efetuar o login, siga o passo a passo abaixo utilizando o tinker:

php artisan tinker

$user = new App\Models\User();
$user->name = "Carlos";
$user->email = "carlos@teste.com.br";
$user->password = bcrypt("1234");
$user->save();


### Atribuir o Token a variável da collection
Copie e cole o token gerado pela api /login na variavel {{token}} da collection

## Reset de Senha

### MailTrap
Para realizar os teste de reset de senha e visualizar a senha no email do usuário, configure as credenciais do MailTrap.
Na pasta .ARQUIVOS existem 2 prints mostrando o sucesso do reset e do envio da nova senha para o email do usuário.

## Testes Unitários

### Rodar os testes
php artisan test

## Docker
Todas as configurações do Docker estão feitas.
Observação: Os containers estão subindo normalmente, porém ainda não executei o projeto no Docker.