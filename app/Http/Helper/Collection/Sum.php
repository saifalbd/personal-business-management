<?php


namespace App\Http\Helper\Collection;


use App\Exceptions\FetalException;
use Illuminate\Support\Arr;

class Sum
{

    private $resource;
    private $keys;
    private $data = [];

    public function __construct($resource,$keys)
    {
        $this->resource = $this->validData($resource);
        $this->keys = $this->validKeys($keys);
    }


    private  function validKeys(array $keys){


        return $keys;
    }
    private function validData(array $data){

        return $data;
    }

    private function keyIsExists($sumKey){
      return collect($this->resource)->every(function($value, $key) use ($sumKey){

          $arr = method_exists($value,'toArray')?$value->toArray(''):$value;
          //return key_exists($sumKey,$val);



         $check = Arr::has($arr, $sumKey);

         return $check;

      });

    }

    private function makeSum(){

        foreach ($this->keys as $item){

            if ($this->keyIsExists($item)){
              //  data_fill($data, 'products.desk.discount', 10);

            //  $this->data[$item] = collect($this->resource)->sum($item);
                $this->data[$item] =array_sum( collect($this->resource)->map(function($list,$key) use ($item){
                    return $list[$item];
                })->all());


            }else{
                throw new FetalException("can't find property ".$item." in collection");
            }
        }

        return $this;
    }



    public function finish(){
        $this->makeSum();
        return $this;
    }

    public function toArray(){
        return $this->data;
    }

    use MagicAdd;
}