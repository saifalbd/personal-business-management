<?php

namespace App\Http\Controllers\Api;

use App\Model\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Customer;
use App\Http\Requests\Api\PendingOrSuccessFinder as SuccessFinder;
use App\Http\Resources\Api\PendingResource;
use Illuminate\Http\Response;

class SuccessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

     /**
     * Display the specified resource.
     *
     * @param Request $request
     * @return Response
     */
    public function search(SuccessFinder $request)
    {
    $pay = Payment::latest()->order_payment()->Active();
    if (isset($request->date) || isset($request->vendorid)) {
    if ($request->date) {$pay->where('created_at','like',$request->date.'%');}
   if ($request->vendorid) {
 $v_i = $request->vendorid;
$pay->whereHas('vendors', function ($query) use($v_i) {
    $query->where('id',$v_i);
});

}//end if
};
 $pay->with(['orders:number,type','customers:phone,name','vendors:name']);

return PendingResource::collection($pay->get());
      
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update()
    {

     
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
