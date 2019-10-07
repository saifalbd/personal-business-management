<?php


namespace App\Repositories;


interface InvoiceRepositoryInterface
{

    public function show(string $type,int $id);
    public function publishedPayment(string $type,int $id);
    public function customerShow();
    public function vendorShow();
    public function bindingForBlade($info);

}