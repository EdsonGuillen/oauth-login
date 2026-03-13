# OAuth Login - Laravel

Sistema de autenticación OAuth 2.0 con Laravel Socialite.

## Proveedores soportados
- Discord
- GitHub

## Instalación
```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
```

## Tecnologías
- Laravel 12
- Laravel Socialite
- SocialiteProviders/Discord
- SQLite
