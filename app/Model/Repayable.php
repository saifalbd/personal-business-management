<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Traits\commentRelation;

class Repayable extends Model
{
  use commentRelation;
    protected $with = ['payment'];

	
	protected $fillable = ['type','group','payment_id'];
      public function customer()
    {
        return $this->belongsTo('App\Model\Customer');
    }

    public function payment()
    {
        return $this->belongsTo('App\Model\payment');
    }

    public function scopeDues($q){
        return $q->where('group','due');
    }

    public function scopePaids($q){
        return $q->where('group','paid');
    }

    public static function addPayment($amount,string $type,string $comment = null){

       $pay = Payment::Create(['paytype'=>$type,'amount'=>$amount]);

       if ($comment):
           $pay->createCommentAdd($comment);
       endif;
       return $pay;

    }

    public static function addPaid(int $customerId,float $amount,$comment = null){


       return Customer::findOrFail($customerId)->repayables()
            ->save(new Repayable(
                [
                    'group'=>'paid',
                    'type'=>'payment',
                    'payment_id'=>self::addPayment($amount,'paid',$comment)->id
                ]
            ));


    }

    public static function addDue(int $customerId,float $amount,string $type,string $comment = null){

        return Customer::findOrFail($customerId)->repayables()
            ->save(new Repayable(
                [
                    'group'=>'due',
                    'type'=>$type,
                    'payment_id'=>self::addPayment($amount,'due',$comment)->id
                ]
            ));
    }

    public function scopeIsPayment($q)
    {
    	return $q->where('group','payment');
    }
   public function scopeIsDue($q)
    {
    	return $q->where('group','due');
    }
  






     public function getAmountAttribute(){
    	return $this->payment->amount;
    	
    }
   // protected $with = ['payment'];
   
}
