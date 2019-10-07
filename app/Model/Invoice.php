<?php

namespace App\Model;

use App\Http\Helper\Collection\DbCollection;
use App\Http\Resources\Invoice\CreditPayment;
use App\Http\Resources\Invoice\DebitPayment;
use App\Http\Resources\Invoice\DueResource;
use App\Http\Resources\Invoice\PaidResource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Traits\commentRelation;
use App\Http\Resources\Invoice\OrderPayment;

class Invoice extends Model
{

    protected $fillable = ['customer_id','vendor_id','invoice_id','stock','start_time','end_time'];

      public function comments(){return $this->morphMany(Payment::class, 'commentable');}



    public function payments(){
          return $this->morphToMany(Payment::class, 'paymentable')->orderByDesc('created_at');}


    public function scopePending($query){
        $query->where('publish',0);
    }
    public function scopePublished($query){
        $query->where('publish',1);
    }







    public function orderPayment(){
          return $this->payments()->whereHas('orders')->with(['orders'=>function($q){
              return $q->addSelect('number');
          }]);
    }

    public function vendorPayment(){
        return  $this->payments()->whereHas('vendors')->doesntHave('orders');

    }
    public function debitPayment(){
        return  $this->vendorPayment()->where('paytype','debit');

    }

    public function creditPayment(){
        return  $this->vendorPayment()->where('paytype','credit');

    }

    public function getIsCustomerAttribute(){return $this->customer_id;}

    public function getIsVendorAttribute(){return $this->vendor_id;}

    public function customer(){
          return $this->belongsTo(Customer::class);
    }

    public function vendor(){
          return $this->belongsTo(Vendor::class);
    }


    public function getStatusAttribute(){
          return $this->publish ? 'publised':'pending';
    }
    public function getCanVendorAttribute(){return $this->vendor??false;}
    public function getCanCustomerAttribute(){return $this->customer??false;}




    function getOrderPaymentResAttribute()
    {
        return  (new DbCollection($this->orderPayment))
            ->resource(OrderPayment::class)
            ->sum(['amount','bill'])
            ->get();

    }

    function getDebitPaymentResAttribute()
    {
        return  (new DbCollection($this->debitPayment))
            ->resource(DebitPayment::class)
            ->sum(['amount'])
            ->get();

    }

    function getCreditPaymentResAttribute()
    {
        return  (new DbCollection($this->creditPayment))
            ->resource(CreditPayment::class)
            ->sum(['amount'])
            ->get();

    }

    function getRepayableDuesResAttribute()
    {
        return  (new DbCollection($this->repayableDues))
            ->resource(DueResource::class)
            ->sum(['amount'])
            ->get();

    }

    function getRepayablePaidsResAttribute()
    {
        return  (new DbCollection($this->repayablePaids))
            ->resource(PaidResource::class)
            ->sum(['amount'])
            ->get();

    }



    /*---------------------------------
for customer replayeble
------------------------------------*/

    public function repayable(){

        return $this->payments()->repayablePayments();

    }

    public function repayableDues(){

        return $this->payments()->repayablePayments('due');

    }

    public function repayablePaids(){

        return $this->payments()->repayablePayments('paid');


    }




    /*---------------------------------
end customer replayeble
------------------------------------*/


    public function getParentAttribute()
    {
        if ($this->customer_id){
            $p = $this->customer;
            return ['type'=>'customer','name'=>$p->name,'parent_id'=>$p->id];
        }else if ($this->vendor_id){
            $p = $this->vendor;
            return ['type'=>'vendor','name'=>$p->name,'parent_id'=>$p->id];
        }
        return [];
    }

    public function getOldStockAttribute()
    {
        $parentIs = null;
      $parent = $this->parent;
      if ($parent['type']=='customer'){
          $parentIs =  Customer::find($parent['parent_id']);
      }else if ($parent['type']=='vendor'){
          $parentIs =    Vendor::find($parent['parent_id']);
      }
      if ($parentIs){
        $invoice =  $parentIs->publishedInvoice()->latest()->first();
        if ($invoice){
          return  $invoice->stock;
        }
      }

      return 0;
    }
    public function getBalanceAttribute()
    {
        $oldStock = $this->OldStock;

        if ($this->publish){
            return $oldStock;
        }
        $bal = 0;
        $order = $this->OrderPaymentRes->sum->amount;
        if($this->IsVendor){
            $credit = $this->CreditPaymentRes->sum->amount;
            $debit = $this->DebitPaymentRes->sum->amount;

            $bal= $credit-($order+$debit);


        }elseif ($this->IsCustomer){
            $due = $this->RepayableDuesRes->sum->amount;
            $paid = $this->RepayablePaidsRes->sum->amount;
            $order = $this->OrderPaymentRes->sum->bill;
            if ($this->customer->canReseller){

                $bal= $order+$due-$paid;
            }else{
                $bal= $order+$due-$paid;
            }

        }
        return $bal+$oldStock;


    }


}
