<?php


namespace App\Repositories;


interface VendorRepositoryInterface
{
    public function apiGetCredits(int $vendorId,int $limit=15);
    public function apiGetDebits(int $vendorId,int $limit=15);
    public function getStock(int $vendorId);

}