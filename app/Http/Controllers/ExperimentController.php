<?php

namespace App\Http\Controllers;

use App\Exceptions\FetalException;
use App\Model\Order;
use App\Model\Vendor;
use App\Repositories\InvoiceRepository;
use App\Repositories\PaymentRepositoryInterface;
use App\Repositories\TariffRepository;
use Illuminate\Support\Facades\DB;
use App\Model\Payment;

class ExperimentController extends Controller
{


    private $customer;
    private $currentPayment;
    protected $payment;
    public function __construct(PaymentRepositoryInterface $payment)
    {

        $this->payment = $payment;

    }


    public function testFun(){



        $info = Vendor::forgotType('invoice')->findOrFail(2);


        $beforeLastId = $info->invoices()->published()->latest()->first()->payments()->latest()->first()->id;

        $pay =$info->payments->where('id','>',$beforeLastId );
       // return $info->payments;
       // return $info->orderPayment;
       // return $idBundle;


       // $pay = Payment::Order_payment()->where('id','>',$beforeLastId )
          //  ->with('vendors','orders')->get();
        $collection =   $pay->filter(function ($item){
            $role =  $item->id <741;

            return $role;
        });




        $invce = new InvoiceController(new InvoiceRepository);
        foreach ($collection as $item){

           $invce->pushPayment('vendor',2,$item->id);
        }


//eturn redirect('http://hisabnikash.lara/vendors/2/show');







    }

public function withEmpliment()
{






}





public function testError()
{

$x = 2522;

  // something went wrong and you want to throw CustomException
     //   throw new \App\Exceptions\CustomException('Something Went Wrong.');
if($x )
throw new FetalException('Division by zero.');
/*
 try {
    
    } catch (\App\Exceptions\CustomException $e) {
        report($e);

        return false;
    }
*/
}





public function withPayment($Q)
{//146, 212
return $Q->select('id','amount')->whereBetween('id', [0, 77])->whereHas('vendors',function($Q){return $Q->where('id',2);})
->with('comments');
//->with('vendors');
}



    public function onDemand()
    {





    }
    public function getPaymentable()
    {

       // return  Customer::find(1)->repayables;
     return   Payment::find(443)->repayable;
    }

    public function setPaymentable()
    {
    DB::table('paymentables')->where('paymentable_type', 'App\Model\Customer')->update(['paymentable_type' => 'customer']);
    DB::table('paymentables')->where('paymentable_type', 'App\Model\Order')->update(['paymentable_type' => 'order']);
    DB::table('paymentables')->where('paymentable_type', 'App\Model\Vendor')->update(['paymentable_type' => 'vendor']);

            return redirect()->action('ExperimentController@getPaymentable');
    	
    }

    public function getEmptyOrder()
    {
    	 $infos = Order::doesntHave('payments')->get();
    	 return $infos;
    	
    }

    public function setEmptyOrder()
    {
 

            return redirect()->action('ExperimentController@getEmptyOrder');
    	
    }
}
