<?php

namespace App\Http\Middleware;

use App\Exceptions\FormException;
use App\Model\Invoice;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class isCurrentInvoice
{



    protected function canAttach(){



    }

    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $type = $request->route('type') ;
        $parent = $type.'_id';
        $id = $request->route('id');



        if ($type =="vendor" || $type =="customer") {

            $findParent = '\App\Model\\'.Str::camel( $type );


            if ($findParent::find($id)){

       $is = Invoice::where([$parent=>$id,'publish'=>false])->first();


       if ($is){
           return $next($request);
       }else{

          throw new FormException('first Genarate Invoice then push payment');
       }
            }else{

                throw new FormException("can't find ".$type);

            }
        }else{
            throw new FormException('type allow only customer or vendor'.$type);


        }

    }
}
