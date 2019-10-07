<?php

namespace App\Providers;

use App\Model\Customer;
use App\Model\Invoice;
use App\Model\Order;
use App\Model\Vendor;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Relations\Relation;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
         Schema::defaultStringLength(191);
         /*
        if ($this->app->environment() == 'local') {
            $this->app->register('Kurt\Repoist\RepoistServiceProvider');
        }
         */
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
              Relation::morphMap([
                  'customer' => Customer::class,
                  'vendor' => Vendor::class,
                  'order' => Order::class,
                  'invoice'=> Invoice::class
              ]);






    }
}
