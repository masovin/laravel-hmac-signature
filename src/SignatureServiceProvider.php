<?php

namespace LaravelSignature;

use Illuminate\Support\ServiceProvider;

class SignatureServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/Configs' => config_path('/')
        ], 'laravel-signature');
    }

    public function register()
    {
    }
}
