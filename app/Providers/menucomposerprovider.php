<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;
use Illuminate\Contracts\View\Factory; 
use App\danhmuc;
use App\loaidanhmuc;
use App\theloai;
use App\phanloai;

class menucomposerprovider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // $this->composerMenu();
        $this->app->singleton(menucomposer::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->share('danhmuc', danhmuc::all());
        view()->share('theloai', theloai::all());
        view()->share('loaidanhmuc', loaidanhmuc::all());
        view()->share('phanloai', phanloai::all());
         view()->share('dms', danhmuc::all());
        // View()->composer('user.blocks.header',function($view){
        //     $view->with('danhmuc', danhmuc::all()->toArray());
        // });
    }
    public function composerMenu(){
        // view()->composer('user.blocks.header','App\Http\Composers\menucomposer');
    }
}
