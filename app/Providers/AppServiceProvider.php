<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->share("LOGO_NAME", 'PHP_Techy.png');
        view()->share("PHONE_NUMBER", '(+91) 9876543210');

        config(['constants.PRODUCT_IMAGE_PATH' => config('constants.IMAGE_PATH') . config('constants.PRODUCT_PATH')]);
        config(['constants.SLIDER_IMAGE_PATH' => config('constants.IMAGE_PATH') . config('constants.SLIDER_PATH')]);
        config(['constants.CATEGORY_IMAGE_PATH' => config('constants.IMAGE_PATH') . config('constants.CATEGORY_PATH')]);
    }
}
