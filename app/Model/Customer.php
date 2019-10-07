<?php

namespace App\Model;

use App\Traits\CustomerRole;
use Illuminate\Database\Eloquent\Model;
use App\Traits\commentRelation;
use Illuminate\Support\Arr;
use App\Exceptions\FetalException as Err;

class Customer extends Model
{
   use commentRelation,CustomerRole;
  protected  $fillable = ['phone','name','tariff_id','city'];
  protected $defaultTariffId = 1;

  public function orders()
  {
   return $this->belongsToMany('App\Model\Order');

   }

   /*----------------------------------------------
   invoice methods
   -----------------------------------------------*/
   public function invoices(){
      return $this->hasMany(Invoice::class);
   }

    /*----------------------------------------------
invoice methods
-----------------------------------------------*/
  

    public function publishedInvoice(){
        return $this->invoices()->published();
    }
    public function pendingInvoice(){
        return $this->invoices()->pending();
    }
    public function getHasPendingInvoiceAttribute(){

        return $this->invoices()->where('publish',0)->first();

    }


    public function tariff(){
       return $this->belongsTo(Tariff::class);
    }

    /**
     * Get all of the customer's payments.
     */
public function comments(){return $this->morphMany('App\Model\comment', 'commentable');}

    

     
public function payments(){return $this->morphToMany('App\Model\Payment', 'paymentable');}

public function orderPayments(){
    return $this->payments()->order_payment();
}


public function repayables()
    {
        return $this->hasMany('App\Model\Repayable');
    }

public function scopeRepayableCustomers($query)
{
  return $query->has('repayables');
}

/**
 * [repayableDues is return repayable tables colunms where type = not payment]
 * @return [type] [qurey]
 */
public function repayableDues()
{
  return $this->repayables()->dues();
}
/**
 * [repayablePayments is return repayable tables colunms where type =  payment]
 * @return [type] [qurey]
 */

public function repayablePayments()
{
  return $this->repayables()->where('group','paid');
}
/**
 * [getRepayablePaymentTotalAttribute sum of payment]
 * @return [type] [total amount int]
 */
public function getRepayablePaymentTotalAttribute()
{
  $array = $this->repayablePayments()->IsPayment()->with('payment:amount,id')->get();
  $names = Arr::pluck($array, 'payment.amount');
  return array_sum($names);
}

/**
 * [getRepayableDueTotalAttribute sum of dues]
 * @return [type] [total dues amount int]
 */

public function getRepayableDueTotalAttribute()
{
    $array =  $this->repayableDues()->with('payment:amount,id')->get();
    $names = Arr::pluck($array, 'payment.amount');
    return array_sum($names);
}








}
