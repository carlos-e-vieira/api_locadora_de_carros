# Locadora de Carros - Backend (v1)
Projeto de teste - backend da aplicação Locadora de Carros.

## Configurando Ambiente de Desenvolvimento

# Rodar o composer
sudo composer install

# Rodar migrations e seeders
php artisan migrate --seed

## Autenticação do Sistema

# Importar collection
Importe o arquivo Collection_Postman.json que está na raiz do projeto.

# Gerar Token
Na collection do postman, acesse o endpoint /login dentro da pasta Autenticação para gerar o token.
No body da request está as credenciais que foram geradas na seeders.
Caso você queira criar um usuário para efetuar o login, siga o passo a passo abaixo utilizando o tinker:

php artisan tinker

$user = new App\Models\User();
$user->name = "Carlos";
$user->email = "carlos@teste.com.br";
$user->password = bcrypt("1234");
$user->save();


# Atribuir o Token a variavél da collection
Copie e cole o token gerado pela api na variavel {{token}} da collection
