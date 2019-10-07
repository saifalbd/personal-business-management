<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\FormException;
use App\Http\Requests\Api\MakeOrder;
use App\Http\Requests\billUpdate;
use App\Model\Payment;
use App\Repositories\PaymentRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Order;
use App\Model\StoreList;
use App\Http\Resources\Api\OrderResource;
use Illuminate\Http\Response;

class OrderController extends Controller
{

    protected $payment;

    public function __construct(PaymentRepository $payment)
    {
        $this->payment = $payment;
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

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(MakeOrder $request)
    {
        $type = $request->type;
        $number = $request->number;
        $order = Order::firstOrCreate(
            ['number' =>$number],
            ['type' => $type]
        );
        return Response()->json($order,201);
    }

    public function billUpdate(billUpdate $bill){


        //billUpdate
        $paymentId=$bill->paymentId;
        $oldBill=$bill->oldBill;
        $newBill=$bill->newBill;


        $payment  = Payment::Order_payment()->find($paymentId);


        if (!$payment){
            throw new FormException('invalid payment id');
        }
        $vendor = $payment->vendors()->first();

        if ($payment->bill!=$oldBill){
            throw new FormException('old bill not match');
        }

        $payment->bill = $newBill;
        $payment->profit = $this->payment->makeProfit($payment,$vendor,$newBill);

        if ($payment->save()){
            return \response()->json(['updated'=>'successFully updated Bill']);
        }else{
            return \response()->json(['errors'=>[
                'messages'=>'successFully updated Bill'
            ]],422);
        }


    }



    public function oldDataBaseFinder($number)
    {
        $storeList = StoreList::where('rec_num','like',$number.'%')->get();
        $result = [];
        foreach ($storeList as $list) {
            $c = [
                'name'=>$list->sender_name,
                'phone'=>$list->sender_num,
                'city'=>null,
                'counts'=>0,
                'number'=>$list->rec_num,
                'type'=>$list->rec_num_type
            ];
            array_push($result,$c);
        };

        return $result;

    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($number)
    {
        $order =   Order::where('number','like',$number.'%')->with(['customers' => function ($query) {
            $query->select(['phone','name','city'])->distinct('phone');
        }])->get();

        $result = [];

        foreach ($order as $list) {

            foreach ($list->customers as $customer) {

                $customer['counts'] =$list->payments()->count();;
                $customer['number'] = $list->number;
                $customer['type'] = $list->type;
                array_push($result, $customer);
            }
        }

        return Response()->json($result);




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
