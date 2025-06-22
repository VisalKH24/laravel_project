<?php

namespace App\Providers;

use App\Models\Logo;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Pagination\Paginator as PaginationPaginator;
use Illuminate\Support\ServiceProvider;
 use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     * 
     */

    

// public function boot()
// {
//     View::composer('*', function ($view) {
//         $logo = Logo::take(1)->get();
//         $view->with('logo', $logo);
//     });
//     PaginationPaginator::useBootstrap();
// }
    public function boot(): void
    {
        view()->composer('Frontend.*', function($view) {
    $logo = Logo::orderBy('id', 'DESC')->limit(1)->get();
    $view->with('logo', $logo);
});

        // view()->composer('Frontend.layout',function($view){
        //     $logo=Logo::query()
        //             ->orderBy('id','DESC')
        //             ->limit(1)
        //             ->get();

        //      $view->with('logo',$logo);
        // });
        
        PaginationPaginator::useBootstrap();
    }
}
