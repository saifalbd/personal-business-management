<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('from', function (Builder  $builder) {
            $builder->orderBy('from', 'asc');
        });
    }



    protected $fillable  = ['from','to','withCharge','tariff_id'];


    public function tariff(){
      return  $this->belongsTo(Tariff::class);

    }

     public function getForeignWithFeeAttribute()
    {
    	return $this->withCharge;
    }

    public function getCustomerRateAttribute(){
    	return round($this->withCharge/$this->from,3);
    	
    }
}
