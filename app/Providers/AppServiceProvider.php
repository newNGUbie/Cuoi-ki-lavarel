<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
     */
    public function boot(): void
    {
        \Illuminate\Support\Facades\View::composer('layout.header', function($view){
            $loai_sp = \App\Models\ProductType::all();
            $view->with('loai_sp', $loai_sp);
        });

        \Illuminate\Support\Facades\View::composer(['layout.header', 'checkout'], function($view){
            if(\Illuminate\Support\Facades\Session::has('cart')){
                $oldCart = \Illuminate\Support\Facades\Session::get('cart');
                $cart = new \App\Models\Cart($oldCart);
                $view->with(['cart' => \Illuminate\Support\Facades\Session::get('cart'), 'productCarts' => $cart->items, 'totalPrice' => $cart->totalPrice, 'totalQty' => $cart->totalQty]);
            }
        });
    }
}
