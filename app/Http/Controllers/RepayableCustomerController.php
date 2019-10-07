<?php

namespace App\Http\Controllers;

use App\Model\Option;
use Illuminate\Http\Request;
use App\Model\Customer;
use App\Model\Repayable;
use App\Model\Payment;
use App\Http\Requests\RepayableCreate;
use Illuminate\Http\Response;

class RepayableCustomerController extends Controller
{
 /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
       
       
      $info =  Customer::RepayableCustomers()->paginate(15);
    
 

     // return $info ;
      return $this->withView('pages.repayableCustomer',['rowList'=>$info]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
 
    public function create($customerid)
    {
        $customer = Customer::findOrFail($customerid);

      $Repayable =  Option::Repayable()->get();

      if (count($Repayable)) {
         $customer['repayable'] = $Repayable;
         return $this->withView('pages.repayableCreate',['info'=>$customer]);

      }else{
        return redirect()->route('option',['params'=>'repayable']);
      }
        
        
    }



/**
 * [repayableDueSave description]
 * @param  [type] $customer [id]
 * @param  [type] $request  [description]
 * @return [type]           [description]
 */
   protected function repayableDueSave($customer,$request){

       return Repayable::addDue($customer->id,$request->due,$request->type);

       //return $customer->repayables()->save(new Repayable(['type'=>$request->type,'due'=>$request->due]));
}
/**
 * [repayablePaymentSave description]
 * @param  [type] $customer [customer id]
 * @param  [type] $request  [description]
 * @return [type]           [description]
 */
   protected function repayablePaymentSave($customer,$request){
  $pay = Payment::Create(['paytype'=>'repayable','amount'=>$request->payment]);
return $customer->repayables()
->save(new Repayable(['type'=>'payment','payment_id'=>$pay->id]));
} 







    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    
 
    public function store(RepayableCreate $req,$customerid)
    {

  

 $customer = Customer::findOrFail($customerid);

$due = $req->due;
$pay = $req->payment;
$comment = $req->comment ??null;

    if ($due && !$pay) {

        Repayable::addDue($customer->id,$due,$req->type,$comment);

    }else if(!$due && $pay){
        Repayable::addPaid($customer->id,$pay,$comment);

}else if($due && $pay){
        Repayable::addDue($customer->id,$due,$req->type,$comment);
        Repayable::addPaid($customer->id,$pay,$comment);
}
    
    
    //$customer->repayableCustomers()->save($rep);
     return redirect()->route('customer.show',['id'=>$customerid])
     ->with('success', 'successfully! insert Repayable Payment');
    }
 

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        
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
    public function update(Request $request, $id)
    {
        //
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
