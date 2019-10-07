<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Traits\commentRelation;

class ExHistory extends Model
{
    protected $fillable  = ['ex_rate'];
    public function comments(){return $this->morphMany('App\Model\Payment', 'commentable');}
}
