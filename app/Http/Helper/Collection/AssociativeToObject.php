<?php


namespace App\Http\Helper\Collection;

use App\Exceptions\FetalException as Err;

class AssociativeToObject
{
    private $data;


    public function __construct($resource)
    {

        $this->data = $this->dataValidation($resource);

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
        return collect($this->data)->toArray();

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
        //return $this->data['pagination'];

        if (array_key_exists($name,$this->data)):


            return $this->data[$name];


        else:

            throw new Err($name.' property not exists');
        endif;
    }

    public function __toString()
    {
        return  json_encode($this->data);
    }

}