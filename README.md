<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Fidelidade API/fidelidade-api

API REST que tem como objetivo controlar um programa de fidelidade de clientes de uma empresa.

## Requisitos

Antes de iniciar, certifique-se de que você tenha os seguintes itens instalados na sua máquina:

- PHP >= 8.4
- Composer
- MySQL
- Laravel  12
- git

## Instalação

Clone o repositório:

```bash
git clone https://github.com/ogabrielxx/fidelidade-api.git
cd fidelidade-api
```

Instalação de dependências:

```bash
composer install
```

Copie o .env.example e renomeie para .env e conecte a seu banco de dados MySQL

Geração da chave do projeto:

```bash
php artisan key:generate
```

Migre as tabelas e popule com seeders:

```bash
php artisan migrate

php arisan db:seed
```

## Hora de rodar!

Para iniciar o projeto:

```bash
php artisan serve
```

Para iniciar as filas:

```bash
php artisan queue:work --queue=resgate,pontuar,diario
```

Para iniciar o agendador de tarefas:

```bash
php artisan schedule:work
```

## E pronto! Sua api está devidamente configurada e pronta para uso!
