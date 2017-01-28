<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Validator\CustomValidationRule;
use Validator;
use App\Http\Validators\HashValidator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
      Validator::resolver(function ($translator, $data, $rules, $messages) {
           return new CustomValidationRule($translator, $data, $rules, $messages);
       });
        Validator::resolver(function($translator, $data, $rules, $messages) {
            return new HashValidator($translator, $data, $rules, $messages);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
