<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Traits\{commentRelation,afterQuery};

class Option extends Model
{
      use commentRelation,afterQuery;
	protected $fillable = ['group_name','option_name','option_value'];
      public function comments(){return $this->morphMany('App\Model\Pomment', 'commentable');}
      public function scopeRepayable($query)
      {
      	return $query->where('group_name','repayable')->latest();
      }
      public function scopeCurrentRate($query)
      {
      	return $query->where('group_name','current_rate')->latest()->take(1);
      }

      public static function getCurrentRate()
      {
      	return  self::CurrentRate()->first();
            //?:redirect()->route('option',['params'=>'currentrate']);
      	
      	
      }
      public static function getCurrentRates()
      {
      	return self::CurrentRate()->get();
      	//return count($infos)?$infos:redirect()->route('option',['params'=>'currentrate']);

      	
      }

      public static function setCurrentRate($val)
      {
      	return self::Create(['group_name'=>'current-rate','option_name'=>'bankRate','option_value'=>$val]);
      }
      public function getRateAttribute()
      {
      	return $this->option_value;
      }
}
