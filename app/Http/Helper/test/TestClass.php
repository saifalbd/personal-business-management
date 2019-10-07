<?php

namespace App\Http\Helper\test;

//use App\Http\Helper\test\TestClass;
//$test = new \App\Http\Helper\test\TestClass;

class TestClass
{
	
   private $a = 2;
    public $b = 1;
    public $c = ['a'=>'aa','b'=>'bb'];
    private $d;
    static $e;
   
    public function test() {
    	$x = (object) ['eva'=>['e'=>'v']];
        return get_object_vars($x);
    }

 
 } 

