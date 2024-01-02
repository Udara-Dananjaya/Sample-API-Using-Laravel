PS C:\xampp\htdocs\SampleApi> php -v

PS C:\xampp\htdocs\SampleApi> php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" 

php -r "if (hash_file('sha384', 'composer-setup.php') === 'e21205b207c3ff031906575712edab6f13eb0b361f2085f1f1237b7126d785e826a450292b6cfd1d64d92e6563bbde02') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"

PS C:\xampp\htdocs\SampleApi> php composer-setup.php   

PS C:\xampp\htdocs\SampleApi> php -r "unlink('composer-setup.php');"

PS C:\xampp\htdocs\SampleApi> composer.phar

PS C:\xampp\htdocs\SampleApi>  composer    

PS C:\xampp\htdocs\SampleApi> artisan migrate

PS C:\xampp\htdocs\SampleApi> php artisan make:model User

PS C:\xampp\htdocs\SampleApi> php artisan make:controller UserController

PS C:\xampp\htdocs\SampleApi> php artisan migrate   

PS C:\xampp\htdocs\SampleApi> php artisan route:list   

PS C:\xampp\htdocs\SampleApi> php artisan route:cache  

PS C:\xampp\htdocs\SampleApi> php artisan tinker       

PS C:\xampp\htdocs\SampleApi> php artisan route:clear  

PS C:\xampp\htdocs\SampleApi> composer global require laravel/installer

PS C:\xampp\htdocs\SampleApi> php artisan serve        

PS C:\xampp\htdocs\SampleApi> composer require tymon/jwt-auth

PS C:\xampp\htdocs\SampleApi> php artisan make:controller AuthController

PS C:\xampp\htdocs\SampleApi> php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"

PS C:\xampp\htdocs\SampleApi> php artisan jwt:secret   
jwt-auth secret [eHMegDHU8TMcT4b4Vs6aJc06wHmKE02KMAZpbaQCAhcHi3rbsKDovW27ARk9YX5J] set successfully.
PS C:\xampp\htdocs\SampleApi> 


composer require tymon/jwt-auth --ignore-platform-reqs

 php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"

php artisan jwt:secret

PS C:\xampp\htdocs\SampleApi> php artisan make:middleware JwtMiddleware