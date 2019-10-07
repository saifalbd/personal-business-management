<?php


namespace App\Traits;


use App\Exceptions\FetalException as Err;

trait MagicAdd
{



    public function toJson(){

        return json_encode($this->toArray());
    }

    public function __isset($name)
    {
        isset($this->data[$name]);
    }

    public function __unset($name)
    {

        unset($this->data[$name]);
    }


    public function __get($name)
    {


        if (array_key_exists($name,$this->data)):


            return $this->data[$name];


        else:

            throw new Err($name.' property not exists');
        endif;
    }

    public function __toString()
    {
        return  json_encode($this->toArray());
    }

}