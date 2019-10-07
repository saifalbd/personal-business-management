<?php


namespace App\Repositories;


use App\Model\Payment;
use App\Model\Vendor;
use Illuminate\Database\Eloquent\Builder;

class VendorRepository implements VendorRepositoryInterface
{
    /**
     * @param Vendor $vendor
     * @return Builder $query->doesntHave('orders')->doesntHave('customers')->has('vendors')
     */

    private function getOrderPaysQuery(Vendor $vendor):Builder{
        return Payment::order_payment()->whereHas('vendors', function ($query) use($vendor) {
            $query->where('id',$vendor->id);
        });
    }
    private function getVendorPaysQuery(Vendor $vendor):Builder{
        return Payment::vendor_payment()->whereHas('vendors', function ($query) use($vendor) {
            $query->where('id',$vendor->id);
        });
}
    public function apiGetCredits(int $vendorId,int $limit=15){
        $vendor = Vendor::findOrFail($vendorId);
       return $this->getVendorPaysQuery($vendor)->credits()->latest()->limit($limit)->get();

    }
    public function apiGetDebits(int $vendorId,int $limit=15){
        $vendor = Vendor::findOrFail($vendorId);
        return $this->getVendorPaysQuery($vendor)->debits()->latest()->limit($limit)->get();
    }

    public function getStock(int $vendorId){
        $vendor= Vendor::findOrFail($vendorId);
      $order = $this->getOrderPaysQuery($vendor)->sum('amount');
      $debit = $this->getVendorPaysQuery($vendor)->debits()->sum('amount');
      $credit = $this->getVendorPaysQuery($vendor)->credits()->sum('amount');

      $totalDebit = $order+$debit;
      return $credit-$totalDebit;

    }


}