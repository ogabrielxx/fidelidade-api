<?php

use App\Http\Middleware\AuthTokenMiddleware;

return [
    'auth.token' => AuthTokenMiddleware::class,
];
