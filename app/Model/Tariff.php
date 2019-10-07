<?php

namespace App\Model;

use App\Http\Helper\Collection\DbCollection;
use App\Http\Resources\Table\RateResource;
use Illuminate\Database\Eloquent\Model;

class Tariff extends Model
{

    protected $fillable= ['name'];

    public function customers(){
        return $this->hasMany(Customer::class);
    }

    public function rates(){
        return $this->hasMany(Rate::class);
    }


    public function getRatesResAttribute()
    {
        return  (new DbCollection($this->rates))
            ->resource(RateResource::class)
            ->get();

    }
}
