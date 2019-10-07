<?php

namespace App\Http\Controllers\Api;

use App\Model\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Customer;
use App\Http\Requests\Api\PendingFinder;
use App\Http\Resources\Api\PendingResource;
use Illuminate\Http\Response;

class PendingController extends Controller
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
    public function search(PendingFinder $request)
    {
    $pay = Payment::latest()->order_payment()->InActive();
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
    public function update(int $id,string $role)
    {

      $find =   Payment::find($id);

      if ($role=='active'){
          $find->active = 1;
          $find->save();
      }else if ($role=='inactive'){
          $find->active = 0;
          $find->save();
      }


 return response()->json(['message'=>'successFully '.$role],200);

//return new PendingResource($find);
     
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
