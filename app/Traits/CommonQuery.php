<?php


namespace App\Traits;


trait CommonQuery
{

    public function scopeFromToDate($query,$from,$to){
        return $query->where('created_at','>=',$from)->where('created_at','<=',$to);

}

}