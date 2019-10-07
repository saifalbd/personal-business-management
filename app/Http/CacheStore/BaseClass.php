<?php
 namespace App\CacheStore;

 abstract class BaseClass
 {

protected $table;

public function model()
{
    return $this->table ?? class_basename(get_called_class());
}

public function all(){

}


 }
