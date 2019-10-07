<?php


namespace App\Http\Helper\dropDown;


use Carbon\Carbon;
use Illuminate\Support\Collection;

class DateDrops
{

    protected  $txtFormat = 'l jS \\of F Y';
    protected $valFormat = 'date'; //date or DateTime

    private function hasEvery(Collection $collection,string $col ,string $or=null){

        return $collection->every(function ($value, $key)use ($col,$or) {

            if ($or){
              return $value[$col] || $value[$or] ?true :false;
            }else{
                return $value[$col];
            }

        });

    }

    private function toDateString(string $dateTime){

        $dateIs =  Carbon::createFromFormat('Y-m-d H:i:s', $dateTime);


        $val = $this->valFormat =='date'? $dateIs->toDateString() :$dateIs->toDateTimeString();

       $txt = $dateIs->format('l jS \\of F Y');

        return compact('val','txt');

    }


    public static function distance(Collection $collection){


        $self = new static();
        if ($self->hasEvery($collection,'created_at')){

           return $collection->pluck('created_at')->map(function($item) use ($self){
                return $self->toDateString($item);
           })->unique()->values() ;

        }
    }
}