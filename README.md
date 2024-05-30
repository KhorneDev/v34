# Proyecto Laravel - Coneduca Test

Este proyecto es una aplicación Laravel 11 para Coneduca.

## Requisitos

- PHP >= 8.0
- Composer
- Node.js
- NPM o Yarn
- MySQL (o cualquier otra base de datos que desees usar)

## Instalación

1. **Clonar el repositorio**:

    git clone https://github.com/KhorneDev/laraveltest.git
    cd laraveltest

2. **Instalar dependencias de PHP**:

    composer install


3. **Instalar dependencias de JavaScript**:


    npm install

4. **Configurar el archivo `.env`**:

    cp .env.example .env


5. **Configurar la base de datos**:

    Asegurar contar con base de datos configurada y las credenciales correctas en archivo `.env`. Luego, migra las tablas:

    php artisan migrate
  

7. **Instalar Laravel Breeze**:

    composer require laravel/breeze --dev
    php artisan breeze:install
    npm install && npm run dev
    php artisan migrate


8. **Compilar los assets**:

    npm run dev

9. **Levantar el servidor**:

    php artisan serve


 acceder a aplicación en `http://localhost:8000`.
