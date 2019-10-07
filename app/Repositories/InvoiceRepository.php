<?php


namespace App\Repositories;


use App\Http\Helper\Collection\DbCollection;
use App\Http\Resources\Invoice\InvoiceResource;
use App\Model\Invoice;
use App\Http\Resources\Invoice\CreditPayment;
use App\Http\Resources\Invoice\OrderPayment;


use App\Model\Vendor;
use Illuminate\Database\Eloquent\Collection;
use PhpParser\Node\Stmt\Return_;

class InvoiceRepository implements InvoiceRepositoryInterface
{




    public function bindingForBladeVendor(Invoice $info){




       return $info;

       // return new InvoiceResource($info);

    }
    public function bindingForBlade($info){

    }
    public function customerShow(){

     return Invoice::has('customer')
         ->with(['customer','orderPayment','repayablePaids','repayableDues']);

    }

    public function vendorShow(){

        return Invoice::has('vendor')
            ->with(['vendor','orderPayment','debitPayment','creditPayment']);

    }

    public function show(string $type,int $id){


        if ($type == 'customer'):

       return $this->customerShow()->findOrFail($id);
        else:

            return $this->vendorShow()->findOrFail($id);

                endif;

    }
    public function publishedPayment(string $type,int $id){
        Return Vendor::payments();
    }

}