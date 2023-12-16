## Autenticação - Inser usuario pelo Tinker
php artisan tinker
$user = new App\Models\User();
$user->name = "Carlos";
$user->email = "carlos@teste.com.br";
$user->password = bcrypt("1234");
$user->save();

## Pacote JWT
composer require php-open-source-saver/jwt-auth
php artisan vendor:publish --provider="PHPOpenSourceSaver\JWTAuth\Providers\LaravelServiceProvider"