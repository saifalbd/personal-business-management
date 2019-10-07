<?php

namespace App\Http\Controllers;

use App\Exceptions\FlashMessage\Flash;
use App\Model\Vendor;
use App\Repositories\PaymentRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Requests\RequestCreate;
use App\Http\Requests\RequestEdit;
use App\Model\Customer;
use App\Model\Order;
use App\Model\Payment;
use App\Http\Helper\Profit\ProfitMaker;
use Illuminate\Http\Response;

class RequestController extends Controller
{


    private $payment;
    private $request;

    public function __construct(PaymentRepositoryInterface $payment)
    {

        $this->payment = $payment;
    }





    private function getCustomer(){

        $phone = $this->request->phone;
        $name = $this->request->name;

        return $this->customer->make(compact('phone','name'));

    }

    private function getOrder(){

        $number = $this->request->number;
        $type = $this->request->type;
        Order::firstOrCreate(['number' =>$number],['type' => $type]);
    }

    public function demoStore(){

        $amount = 5100;

        $comment = 'amamar sonar bangla';
        $vendor = 1;

        $customer = [
            'name'=>'suna',
            'phone'=>77777712,
            'city'=>'torkari',
            'comment'=>'sun-kistomer'
        ];
        $order = [
            'number'=>01111111122,
            'type'=>'personal',
            'comment'=>'sun-order'

        ];

        $data = compact('amount','profit','bill','vendor','comment','order','customer');
        return $this->payment->makeOrderPayment($data);
    }

    public function store(RequestCreate $request)
    {


        $this->request = $request;
        $amount = $request->amount;
        $comment = $request->comment??null;
        $vendor = $request->vendor;
        $bill = $request->customerBill ?? null;



        $customer = [
            'name'=>$request->senderName,
            'phone'=>$request->senderNumber,
            'city'=>null,
            'comment'=>null
        ];
        $order = [
            'number'=>$request->number,
            'type'=>$request->type,
            'comment'=>null

        ];
        $arr = compact('amount','vendor','bill','comment','customer','order');



           $req =  $this->payment->makeOrderPayment($arr);


        return redirect()->route('request.show',['id'=>$req->id]);



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
       
        
        $info = Payment::order_payment()->findOrFail($id);
        $lastFive = Payment::order_payment()->
        latest()->take(3)
        ->with(['customers','orders'])
        ->get();


        if (config('view.showRequest')) {
           return $this->withView('pages.requestShow',
    ['info'=>$info,'rowList'=>$lastFive]);
        }else{
            return 'enable config app.work';
        }
   
  

        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $pay = Payment::findOrFail($id);
        return $this->withView('pages.requestEdit',['info'=>$pay]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(RequestEdit $request, $id)
    {





//return $request->order_id;

    $pay = Payment::findOrFail($id);
    if (isset($request->paymentGroup)) {
     $pay->amount = $request->amount;
     $pay->save();} 

$newOrderId = $request->order_id;
   if (isset($request->orderGroup)) {
    $income = new ProfitMaker($request);

   $order = Order::updateOrCreate(
    ['number' =>$request->number],
    ['type' =>$request->type,'profit'=>$income->result()]);
/* relsasn with customer-order Table*/
 $order->customers()->attach($request->senderId);
$newOrderId = $order->id;
   
   /* পেমেন্টকে নতুন নম্বর এর সাথে কানেক্ট করবে */
   $pay->orders()->attach($order->id);
 $order->fresh();

if ($order->id !=$request->order_id) {

 $pay->orders()->detach($request->order_id);
 $oldOrder = Order::find($request->order_id);
if ($oldOrder && $oldOrder->payments && !count($oldOrder->payments)) {
Order::destroy($oldOrder->id);
$oldOrder->customers()->detach();
}  
}


}





    if (isset($request->vendorGroup)) {
    $pay->vendors()->sync([$request->vendor]);
    }


    if (isset($request->customerGroup)) {
    $pay->customers()->sync([$request->senderId]); 
    Customer::find($request->customer_id)->orders()->detach($request->order_id);
    Customer::find($request->senderId)->orders()->attach($newOrderId);
}

if ($request->comment) {
if ($request->commentType =='edit') {
    Payment::find($newOrderId)->comments()->create(['type' =>$request->commentType,'body'=>$request->comment]);}
if ($request->commentType =='vendor') {
    Vendor::find($request->vendor)->comments()->create(['type' =>$request->commentType,'body'=>$request->comment]);}
if ($request->commentType =='order') {
    Order::find($newOrderId)->comments()->create(['type' =>$request->commentType,'body'=>$request->comment]);}
if ($request->commentType =='customer') {
    Customer::find($request->senderId)->comments()->create(['type' =>$request->commentType,'body'=>$request->comment]);}

}

        Flash::updated('successfully! Update Payment');
 return redirect()->route('genaral.pending');

  }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        return 'amamr sonar bangla';
    }
}
