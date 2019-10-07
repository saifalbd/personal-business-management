<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Traits\commentRelation;

class Order extends Model
{

	 use commentRelation;

   protected  $fillable = ['number','type'];

public function customers()
  { return $this->belongsToMany('App\Model\Customer'); }


    public function comments(){return $this->morphMany('App\Model\comment', 'commentable');}
    /**
     * Get all of the order's payments.
     */
    
  


public function payments(){return $this->morphToMany('App\Model\Payment', 'paymentable');}

}
