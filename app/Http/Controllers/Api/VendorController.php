<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\Table\creditDebitForAdd;
use App\Repositories\VendorRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VendorController extends Controller
{

    private $vendor;
    public function __construct(VendorRepositoryInterface $vendor)
    {
        $this->vendor = $vendor;
    }

    public function apiGetCredits(int $vendorId,int $limit=10){
        $pays = $this->vendor->apiGetCredits($vendorId,$limit);
      return  $this->dataConverter($pays,creditDebitForAdd::class)->get()->toJson();
          //->except(['pushUrl', 'invoiceStatus']);
    }
    public function apiGetDebits(int $vendorId,int $limit=10){
        $pays = $this->vendor->apiGetDebits($vendorId,$limit);
        return  $this->dataConverter($pays,creditDebitForAdd::class)->get()->toJson();
    }

}
