<?php

namespace App\Model;

use App\Http\Helper\Collection\DbCollection;
use App\Http\Resources\Vendor\CreditPaymentResource;
use App\Http\Resources\Vendor\DreditPaymentResource;
use App\Repositories\VendorRepository;
use Illuminate\Database\Eloquent\Model;
use App\Traits\commentRelation;
use LogicException;

class Vendor extends Model
{

   use commentRelation;
   
     protected  $fillable =['type','name'];
    /**
     * @var default all
     * if type are publish payments remove invoice all publish payment;
     * if type are pending payments remove invoice all pending payment;
     * if type are invoice payments remove invoice all  payment;
     */
     protected static $forgotTypeIs;





     public  function scopeForgotType($query,string $type){
         $arr = ['publish','pending','invoice'];
         if (!in_array($type,$arr)){
             throw new LogicException('type accepted only '.collect($arr)->join(' or '));
         }
         static::$forgotTypeIs = $type;

         return $query;
    }
    /*----------------------------------------------
invoice methods
-----------------------------------------------*/
    public function invoices(){
        return $this->hasMany(Invoice::class);
    }

    public function publishedInvoice(){
       return $this->invoices()->published();
    }
    public function pendingInvoice(){
        return $this->invoices()->pending();
    }
    public function getHasPendingInvoiceAttribute(){

        return $this->invoices()->where('publish',0)->first();

    }



    public function ExHistory() { return $this->hasMany('App\Model\ExHistory'); }
  public function getRateAttribute() {
   return $this->ExHistory()->first()->ex_rate;
}
    /**
     * Get all of the vendor's payments.
     */
   


public function payments(){
    $payment =  $this->morphToMany('App\Model\Payment', 'paymentable');
   $type = static::$forgotTypeIs;
   if ($type){
       $bundle = [];
       if ($type=='publish'){
           $bundle = $this->publishedInvoice();
       }else if($type=='pending'){
           $bundle = $this->pendingInvoice();
       }else if($type=='invoice'){
           $bundle = $this->invoices();
       }



     $idList =  $bundle->with(['payments'=>function ($qurey){
           $qurey->addSelect('id');
       }])->get()->map(function ($item,$key){
           return $item->payments->pluck('id');
       })->collapse()->all();

       $payment->whereNotIn('id', $idList);
   }

    return $payment->orderByDesc('created_at');

}
public function vendorPayment(){return $this->payments()->doesntHave('orders')->doesntHave('customers');}
public function orderPayment(){return $this->payments()->has('orders')->has('customers')
->WithComments()->WithCustomer()->WithOrders();}
public function vendorCreditPayment(){return $this->vendorPayment()->where('paytype','credit')
->WithComments();}
public function vendorDebitPayment(){return $this->vendorPayment()->where('paytype','debit')
->WithComments();}

public function scopeActive($Q)
{
	return $Q->whereActive(true);
}
  public function getActiveTxtAttribute() {
   return $this->active?'Active':'InActive';
}

  public function  scopeName($Q,$name){

    return $Q->whereName($name);
      
    }

/**
 * sum relationship 
 
 */
    public function getCreditPaymentResAttribute(){
        return  (new DbCollection($this->vendorCreditPayment))
            ->resource(CreditPaymentResource::class)->get();
    }
    public function getDebitPaymentResAttribute(){
        return (new DbCollection($this->vendorCreditPayment))
            ->resource(DreditPaymentResource::class)->get();
    }
public function getTotalCreditAttribute(){return $this->vendorCreditPayment->sum('amount');}
public function getTotalDebitAttribute(){return $this->vendorDebitPayment->sum('amount');}
public function getTotalTotalOrderPaymentAttribute(){return $this->orderPayment->sum('amount');}
public function getTotalStockBalanceAttribute()
{
    $vendor = new VendorRepository();
    return $vendor->getStock($this->id);
//return $this->vendorCreditPayment->sum('amount')-($this->vendorDebitPayment->sum('amount')+$this->orderPayment->sum
//('amount'));
	
}



}
