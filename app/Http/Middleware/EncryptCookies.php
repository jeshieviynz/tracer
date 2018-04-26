<?php

namespace App\Http\Middleware;

use Illuminate\Cookie\Middleware\EncryptCookies as BaseEncrypter;

class EncryptCookies extends BaseEncrypter
{
    /**
     * The names of the cookies that should not be encrypted.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'users' => \App\Http\Middleware\alumni::class,
        'filloutstep1' => \App\Http\Middleware\Admin::class,
        'home' => \App\Http\Middleware\staff::class,
    ]; 
}
