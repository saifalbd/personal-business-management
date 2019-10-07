<?php


namespace App\Http\Helper\Collection;


use App\Exceptions\FetalException as Err;

class MakeCollection
{
    private $data;
    public static $arr;
    public static $obj;



    public function __construct($resource)
    {

        $this->data = $this->dataValidation($resource);
        //self::$datas = $this->dataValidation($resource);
        $this->setArr();
        $this->setObj();

    }

    private function dataValidation($data){

        if (is_array($data)){
            return $data;

        }else{
            throw new Err('only allow type of array');
        }
    }


    public function toArray()
    {

        return collect($this->data)->map(function ($item,$key){
            return   $item->toArray('');
        });

    }



    private function setObj(){
        self::$obj = $this->data;
    }



   private function setArr(){
       self::$arr =   collect($this->data)->map(function ($item,$key){return $item->toArray();});

    }

    public static function obj(){
        return self::$obj;
    }
    public static function arr(){


        return self::$arr;
    }





    public function __get($name)
    {


        if (array_key_exists($name,$this->data)):


            return $this->data[$name];


        else:

            throw new Err($name.' property not exists');
        endif;
    }

    public function toJson(){
        return json_encode($this->toArray(''));
    }

    public function __toString()
    {
        return json_encode($this->toArray(''));
    }

}