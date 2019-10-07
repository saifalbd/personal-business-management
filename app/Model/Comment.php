<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
	protected  $fillable = ['body','type'];
    public function paymentable(){return $this->morphTo();}
}
