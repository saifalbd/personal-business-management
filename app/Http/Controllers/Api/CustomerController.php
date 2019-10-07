<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\FormException;
use App\Http\Helper\Profit\OrderBill;
use App\Http\Requests\Api\MakeCustomer;
use App\Http\Requests\Api\orderFind;
use App\Model\Tariff;
use App\Repositories\CustomerRepository;
use App\Repositories\TariffRepositoryInterface;
use function Composer\Autoload\includeFile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Customer;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Validator;

class CustomerController extends Controller
{

    private $tariff;
    private $customer;

    public function __construct(TariffRepositoryInterface $tariff,CustomerRepository $customer)
    {
        $this->tariff = $tariff;
        $this->customer = $customer;
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
    public function store(MakeCustomer $request)
    {

        $customer = $this->customer->initCustomer($request->name,$request->phone);

        return Response()->json($customer,201);

    }

private function findOrders(string $fieldName,string $val)
{
  $like = '%'.$val.'%';
 $findingCustomer =  Customer::select(['name','phone','id'])
 ->where($fieldName,'like',$like)
 ->with(['orders'=>function ($query){
$query->addSelect('number');
}])->get();

return Response()->json(collect($findingCustomer)->map(function ($item) {
$name = $item->name;
$phone = $item->phone;
$orders = collect($item->orders)->map(function($order) use ($name ,$phone){
  return ['name'=>$name,'phone'=>$phone,'number'=>$order->number];
});
return $orders;
})->collapse()->all());

}
    public function findOrderByName(string $customerName){
      return $this->findOrders('name',$customerName);
    }

    public function findOrderByPhone(string $customerPhone){
      return $this->findOrders('phone',$customerPhone);
    }



    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @return Response
     */
    public function searchByName(string $customerName)
    {

        $like = '%'.$customerName.'%';
       $findingCustomer =  Customer::select(['name','phone','id'])->where('name','like',$like)->get();

       return Response()->json($findingCustomer);


    }
    public function searchByPhone(string $customerPhone)
    {

        $like = '%'.$customerPhone.'%';
        $findingCustomer =  Customer::select(['name','phone','id'])->where('phone','like',$like)->get();
        return Response()->json($findingCustomer);


    }
    public function findByPhone(orderFind $request){
//

        $phone = $request->phone;
        $number = $request->number;
        $amount = floor($request->amount);




        //return Response()->json([compact('phone','amount')],200);

        $customer =  Customer::where('phone',$phone)->first();


        if ($customer){

            $bill = (new OrderBill( $amount))->withCustomer($customer)->getBill();

            $customer['status']='registered';

            $data = [
                'message'=>'registered',
                'customer'=>$customer,
                'bill'=>$bill
            ];

            $num = $customer->orders()->where('number',$number)->first();


            if ($num){

                $num['status']='registered';
                $data['order']=$num->only(['id', 'number','type','status']);

            }



            return Response()->json($data,200);
        }else{
            $bill = (new OrderBill($amount))->getBill();
            return Response()->json([
                'message'=>'unRegistered',
                'bill'=>$bill
            ])->setStatusCode(203, 'unRegistered');
        }

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

    public function rates(){
        $tariff = $this->tariff->getDefault();
        if ($tariff){
            $rates =  $tariff->RatesRes->list->toArray()->map(function ($item,$key){
                return collect($item)->forget(['editUrl','removeUrl','id']);
            });


            return $rates;

        }else{

        }
    }

    private function getTerms(string $type):string {
        $local = trim(config('currency.localSymbol'));
        $foreign = trim(config('currency.foreignSymbol'));
        if ($local==$type):
            return 'this value included with change';
        elseif ($foreign==$type):
            return 'from amount included with change To value with Charge';
        else:
            return null;
        endif;

    }
    private  function getAmountType(string $type):string {
        $local = trim(config('currency.localSymbol'));
        $foreign = trim(config('currency.foreignSymbol'));
        if ($local==$type):
            return $foreign;
        elseif ($foreign==$type):
            return $local;
        else:
            return null;
        endif;
    }
    public function  ratesConvert(Request $request){

        $tariff = $this->tariff->getDefault();
        $local = trim(config('currency.localSymbol'));
        $foreign = trim(config('currency.foreignSymbol'));
        $symbols = [$local,$foreign];

        $error = null;
        $type = $request->type??false;
        $amount = $request->val && is_numeric($request->val)?$request->val : false;

        if ($type):
            if (in_array($type,$symbols)):
                if ($amount):
                    /**
                     * if currencyType is is local return foreign otherwise return local money
                     */

                    $bill = (new OrderBill($amount))->currencyType($type)->getBill();


                    return response()->json([
                        'amount' => $bill,
                        'amountType'=>$this->getAmountType($type),
                        'terms'=>$this->getTerms($type)

                    ]);
                else:
                    return response()->json(['message' => 'convertion amount are missing'],422);
                endif;

            else:

                return response()->json(['message' => 'type not match with Config'],422);

                // throw new FormException('type not match with ');
            endif;

        else:
            return response()->json(['message' => 'convertion type arre missing'],422);


        endif;

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
