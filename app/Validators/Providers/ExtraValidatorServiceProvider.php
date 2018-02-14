<?php

namespace App\Validators\Providers;

use Illuminate\Support\ServiceProvider;
use App\Validators\ExtraValidator;

class ExtraValidatorServiceProvider extends ServiceProvider
{
    public function register(){}

    public function boot()
    {
        $this->app->validator->resolver(function ($translator, $data, $rules, $messages)
        {
            return new ExtraValidator($translator, $data, $rules, $messages);
        });
    }
}