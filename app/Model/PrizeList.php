<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Traits\commentRelation;

class PrizeList extends Model
{
      use commentRelation;
      public function comments(){return $this->morphMany('App\Model\Pomment', 'commentable');}
}
