<?php

namespace App\Traits;

//php artisan make:trait MyTrait 
//command
trait DemoRowModifyer
{
   
   public function scopeGetRun($q)
   {
   return	$q->get();
   }
}