<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://www.evertecinc.com/wp-content/uploads/2022/04/Evertec-lanza-nueva-plataforma-de-pagos-en-linea.jpg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Microsites

A web platform for managing microsites, enabling administrators to register users, manage roles, and create, update, edit, and delete sites. Guest users can explore the microsites and make payments.


## Installation

    1. Clone this repository to your local machine:

       ```bash
       git clone https://github.com/your-username/your-repository.git

    2. Install project dependencies using Composer and NPM:

        composer install
        npm install

    3. Copy the .env.example configuration file and create a new one named .env. Then, update the environment variables according to your configuration:
        
        cp .env.example .env
        php artisan key:generate
        
    4. Run migrations to create the database tables:
        
        php artisan migrate
        
    5. Start the development server:
        
        php artisan serve
        
### Usage

Once the server is up and running, you can access the application from your browser by visiting http://localhost:8000.

## Contributing

Contributions are welcome. If you find any issues or have a suggestion, please open an issue or send a pull request.


## License

Microsites is licensed under the [MIT license](https://opensource.org/licenses/MIT).

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
