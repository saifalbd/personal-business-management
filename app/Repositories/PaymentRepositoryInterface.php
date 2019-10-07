<?php


namespace App\Repositories;



use App\Model\Payment;
use App\Model\Vendor;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

interface PaymentRepositoryInterface
{


    public static function builder(Builder $builder);
    public function idFrom(int $id);
    public function idTo(int $id);
    public function dateFrom(Carbon $carbon);
    public function dateTo(Carbon $carbon);
    public function dateIs(Carbon $carbon);
    public function whereVendor(Vendor $vendor);
    public function getBuild():Builder;



    public function makeOrderPayment(array $arg);
    public function updateOrderPayment(Payment $payment,int $amount,int $bill=null);
    public function makeProfit(Payment $payment,Vendor $vendor,int $bill);
    public function doVendorCredit(array $arg);
    public function doVendorDebit(array $arg);
    public function changeVendor(array $resource);



}