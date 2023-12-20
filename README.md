# Locadora de Carros - Backend (v1)
Projeto de teste - backend da aplicação Locadora de Carros.

## Configurando Ambiente de Desenvolvimento

### Configurar o .ENV
Criar uma cópia do .env.exemple e renomear para .env
cp .env.example .env

### Banco de Dados
#### Rodar Banco Instalado no Servidor
Descomentar as variáveis de ambiente # - Conexão Banco Servidor

#### Rodar Banco Local
Altere os valores das variáveis de ambiente de # - Conexão Banco Local

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
Importe o arquivo Collection_Postman.json que está na raiz do projeto.

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

## Testes Unitários

### Rodar os testes
php artisan test
