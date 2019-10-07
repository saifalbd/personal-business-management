<?php

namespace App\Http\Controllers;

use App\Http\Helper\dropDown\CustomerDrops;
use App\Http\Requests\vueSubmitOrder;
use App\Model\Customer;
use App\Model\Order;
use App\Repositories\PaymentRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Requests\PaymentRemove;
use App\Http\Requests\ChangeEdit\editAmount;
use App\Http\Requests\ChangeEdit\changeVendor;
use App\Http\Requests\ChangeEdit\changeCustomer;
use App\Model\Payment;
use Illuminate\Http\Response;

interface PaymentInterface
{   
 
   
    /**
     * [updateAmount description]
     * @param  editAmount $request [description]
     * @param  int        $payId   [payment id]
     * @return [type]              [route]
     */
    public function updateAmount(editAmount $request,int $payId);
    /**
     * [changeOrder description]
     * @param  int    $payId [payment id]
     * @return [type]        [route]
     */
    public function changeOrder(int $payId);
    /**
     * [updateOrder description]
     * @param  changeVendor $request [description]
     * @param  int          $payId   [payment id]
     * @return [type]                [route]
     */
    public function updateOrder(changeVendor $request,int $payId);
    /**
     * [changeVendor description]
     * @param  int    $payId [payment id]
     * @return [type]        [route]
     */
    public function changeVendor(int $payId);
    /**
     * [changeVendorUpdate description]
     * @param  changeVendor $request [description]
     * @param  int          $payId   [payment id]
     * @return [type]                [route]
     */
     public function changeVendorUpdate(changeVendor $request ,int $payId);
     /**
      * [changeCustomer description]
      * @param  int    $payId [payment id]
      * @return [type]        [route]
      */
     public function changeCustomer(int $payId);
     /**
      * [changeCustomerUpdate description]
      * @param  changeCustomer $request [description]
      * @param  int            $payId   [payment id]
      * @return [type]                  [route]
      */
     public function changeCustomerUpdate(changeCustomer $request ,int $payId);
}

class PaymentController extends Controller implements PaymentInterface
{


    protected $payment;

    public function __construct(PaymentRepositoryInterface $payment)
    {
        $this->payment = $payment;
    }

    protected function findWithQurey(int $id)
    {
       return Payment::Order_payment()
    ->with(['customers:name,id','orders:number,id,type','vendors:name,id'])
    ->findOrFail($id);
    }
    protected function findQurey(int $id)
    {
       return Payment::Order_payment()->findOrFail($id);
    }
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
    public function orderPaymentStore(vueSubmitOrder $pay){

        $customer =Customer::findOrFail($pay->customerId);
        $order = Order::findOrFail($pay->orderId);
        $amount =round(floor($pay->amount));
        $comment = $pay->comment??null;
        $vendor = $pay->vendorId;
        $bill = $pay->bill ?round(floor($pay->bill)): null;


        //dd(var_dump($amount));

        $customer = [
            'name'=>$customer->name,
            'phone'=>$customer->phone,
            'city'=>null,
            'comment'=>null
        ];
        $order = [
            'number'=>$order->number,
            'type'=>$order->type,
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
        //
    }


    public function editBill($payId){
        $pay = Payment::Order_payment()
            ->with(['customers:name,id','orders:number,id,type','vendors:name,id'])
            ->findOrFail($payId);

         return $this->withView('pages.changeAndEditPage.editBill',['info'=>$pay]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
    $pay = Payment::Order_payment()
    ->with(['customers:name,id','orders:number,id,type','vendors:name,id'])
    ->findOrFail($id);
   //return  $pay;


     return $this->withView('pages.changeAndEditPage.paymentEdit',['info'=>$pay]);

    }
    
    public function editAmount($payId){ 
        $pay = $this->findWithQurey($payId);
        return $this->withView('pages.changeAndEditPage.editAmount',['info'=>$pay]);
    }
    /**
     * [updateAmount description]
     * @param  editAmount $request [description]
     * @param  [type] $payId [payment id]
     * @return [type]        [route]
     */
    public function updateAmount(editAmount $request,int $payId){

        $paymentID = $request->paymentID;
        $vendorID = $request->vendorID;
        $customerBill = $request->customerBill ?? null;
        $oldAmount = $request->oldAmount;
        $newAmount = $request->newAmount;
        $comment = $request->comment;
        $pay =  Payment::Order_payment()->amount($oldAmount)->findOrFail($request->paymentID);

        $this->payment->updateOrderPayment($pay,$newAmount, $customerBill);
        if (isset($comment) && $comment) {

            $pay->editCommentAdd($comment);
        }
        return redirect()->route('genaral.pending')->with('success', 'successfully! Update Payment');;
    }
    /**
     * [changeOrder description]
     * @param  [type] $payId [payment id]
     * @return [type]        [route]
     */
    public function changeOrder(int $payId){
        $pay = $this->findWithQurey($payId); 
        return $this->withView('pages.changeAndEditPage.changeOrder',['info'=>$pay]);
    }
    /**
     * [updateOrder description]
     * @param  changeVendor $request [description]
     * @param  [type] $payId [payment id]
     * @return [type]        [route]
     */
    public function updateOrder(changeVendor $request,int $payId){
         $this->findQurey($payId);
    }
    /**
     * [changeVendor description]
     * @param  [type] $payId [payment id]
     * @return [type]        [route]
     */
    public function changeVendor(int $payId){
        $pay = $this->findWithQurey($payId); 
        return $this->withView('pages.changeAndEditPage.changeVendor',['info'=>$pay]);
    }  
/**
 * [changeVendorUpdate description]
 * @param  changeVendor $request [from request]
 * @param  [type]       $payId   [Payment id]
 * @return [type]                [route]
 */
 public function changeVendorUpdate(changeVendor $request ,int $payId){

    $vendorId = $request->newVendorID;
    $customerId = $request->customerID;
    $paymentId = $request->paymentID;
    $comment = $request->comment??null;

          $data = compact('vendorId','customerId','paymentId','comment');

          $this->payment->changeVendor($data);

      return redirect()->route('genaral.pending')->with('success', 'successfully! Change Payment Vendor');
      

    }


    public function changeCustomer(int $payId){
        $pay = $this->findQurey($payId);
        $pay->drops =CustomerDrops::all();
         return $this->withView('pages.changeAndEditPage.changeCustomer',['info'=>$pay]); 
    }

/**
 * [changeCustomerUpdate description]
 * @param  changeCustomer  $request [from request]
 * @param  [type]       $payId   [Payment id]
 * @return [type]                [route]
 */
  public function changeCustomerUpdate(changeCustomer $request ,int $payId){
   
    $pay = $this->findQurey($payId); 

    
      $paymentID = $request->paymentID;
      $oldCustomerID = $request->oldCustomerID;
      $newCustomerID = $request->newCustomerID;
      if ($oldCustomerID!=$newCustomerID) {
          $pay->customers()->sync([$newCustomerID]);

      }
      
      return redirect()->route('genaral.pending')
      ->with('success', 'successfully! Change Payment Customer');
      

    }
   

    public function destroy(PaymentRemove $request, $id)
    {
        $paymentType = $request->paymentType;
        $paymentId = $request->paymentId;
        $customerName = $request->customerName;
        $customerNumber = $request->customerNumber;
        $amount = $request->amount;
        $comment = $request->comment;
        $pay = Payment::Amount($amount)->whereHas('customers',function($q) use ($customerName,$customerNumber){
$q->where(['name'=>$customerName,'phone'=>$customerNumber]);
        })->findOrFail($id);

  if (isset($comment) && $comment) {
          $pay->createCommentAdd($comment); 
           
       }

$pay->delete();

        return  redirect()->route('genaral.pending');
    }
}
