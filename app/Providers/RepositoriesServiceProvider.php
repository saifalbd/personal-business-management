<?php


namespace App\Providers;

use App\Repositories\{
    PaymentRepositoryInterface,
    PaymentRepository,
    InvoiceRepository,
    InvoiceRepositoryInterface,
    CustomerRepositoryInterface,
    CustomerRepository,
    ReportRepositoryInterface,
    ReportRepository,
    OrderRepositoryInterface,
    OrderRepository,
    TariffRepositoryInterface,
    TariffRepository,
    VendorRepositoryInterface,
    VendorRepository
};




use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
{

    private function repository(){

        $classArr = [
            [
                'class'=>PaymentRepository::class,
                'interface'=>PaymentRepositoryInterface::class
            ],
            [
                'class'=>InvoiceRepository::class,
                'interface'=>InvoiceRepositoryInterface::class
            ],
            [
                'class'=>CustomerRepository::class,
                'interface'=>CustomerRepositoryInterface::class
            ],
            [
                'class'=>ReportRepository::class,
                'interface'=>ReportRepositoryInterface::class
            ],
            [
                'class'=>OrderRepository::class,
                'interface'=>OrderRepositoryInterface::class
            ],
            [
                'class'=>TariffRepository::class,
                'interface'=>TariffRepositoryInterface::class
            ],
            [
            'class'=>VendorRepository::class,
            'interface'=>VendorRepositoryInterface::class
        ]
        ];

        return $classArr;

    }
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        foreach ($this->repository() as $list){
        $this->app->bind($list['interface'],$list['class']);
        }


    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {



    }
}
