<?php

namespace App\Http\Controllers;

use App\Exceptions\FlashMessage\Flash;
use App\Exceptions\FormException;
use App\Http\Helper\Collection\DbCollection;
use App\Model\Order;
use App\Model\Tariff;
use App\Http\Requests\CustomerCreate;
use App\Http\Requests\ChangeEdit\editCustomer;
use App\Http\Requests\CustomerFilter;
use App\Http\Resources\Table\CustomerResource;
use App\Http\Resources\Customer\Table\{RepayablePaymentsResource,RepayableDuesResource,OrderPaymentsResource,OrdersRelationResource,OrdersRelationCustomerResource};

use App\Model\Customer;

use App\Repositories\CustomerRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use stdClass;


interface CustomerInterface
{
     /**
   * [customerFilter description]
   * @param  CustomerFilter $request [description]
   * @return [type]                  [route]
   */
    public function customerFilter(CustomerFilter $request);

    /**
     * [editCustomer description]
     * @param  int    $customerId [description]
     * @return [type]             [VIEW]
     */
    
    public function editCustomer(int $customerId);
    /**
     * [updateCustomer description]
     * @param  editCustomer $request    [description]
     * @param  int          $customerId [description]
     * @return [type]                   [redirect route]
     */
    public function updateCustomer(editCustomer $request, int $customerId);

    
}

class CustomerController  extends Controller implements CustomerInterface
{
    protected $limit = 50;
    private $customer;

    public function __construct(CustomerRepositoryInterface $customer)
    {

        $this->customer = $customer;
    }

    protected function customerQuery()
    {
        return Customer::with(['orders','payments']);
    }



    public function dataModifyForVue($infos)
    {

        $rowList =  (new DbCollection($infos))
            ->resource(CustomerResource::class)
            ->get();


return (object) compact('rowList');

    }


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
  


      $list =  $this->customerQuery()->paginate($this->limit);

    $info =  $this->dataModifyForVue($list);
   
        return $this->withView('pages.customer',compact('info'));
    }

    public function customerFilter(CustomerFilter $request){

      
        $info =  $this->customerQuery();

       $customerName =(isset($request->customerName))?$request->customerName:null;
       $customerNumber = (isset($request->customerNumber))?$request->customerNumber:null;



Flash::input('customerName',$customerName);
Flash::input('customerNumber',$customerNumber);





        
        if ($customerName) {
          $info->where('name','like','%'.$customerName.'%');
        }
        if ($customerNumber) {
           $info->where('phone','like','%'.$customerName.'%');
        }
        if (!$customerName && !$customerNumber) {
       
         return redirect()->route('customer');
        }

 $info = (object) $this->dataModifyForVue($info->paginate($this->limit));


      return $this->withView('pages.customer',compact('info'));  
    }
   
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create():string
    {
        $info =new stdClass;
        $info->tariffList= Tariff::select('id','name')->get();

        return $this->withView('pages.customerCreate',compact('info'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(CustomerCreate $request)
    {

        $city = $request->cityName??false;
        $comment = $request->description??false;

        $data = ['name'=>$request->customerName,
            'phone'=>$request->customerPhone,
            'tariffId'=>$request->tariffId];

        if ($city){ $data['city']= $city; }
        if ($comment){ $data['comment']= $comment; }

        $customer = $this->customer->makeCustomer($data);


    return redirect()->route('customer')
    ->with('success', 'successfully! Create New Customer '.$customer->name);


    }

    /**
     * @param int $id
     * @return array
     */
    protected function ordersRelation(int $id)
    {
      $info =   Order::select('id','number','type')->whereHas('customers',function($q) use ($id){
        $q->where('customer_id',$id);

      })->with(['customers'=>function($row){

return $row->has('payments')->distinct('name');
      }])->get();


$collection =  collect($info)->map(function ($item, $key) {
    collect($item->customers)->map(function($list,$key) use($item){
$list['payments_count'] = $list->payments()->whereHas('orders',function($q) use ($item){
    $q->where('number',$item->number);
})->count();
$list->my = $list->id;

return $list;
    })->all();
$cus = $item->customers;
//return var_dump(is_a($item->customers,'Illuminate\Database\Eloquent\Collection'));

unset($item->customers);
$item->customers = $this->dataConverter($cus,OrdersRelationCustomerResource::class)->get();

return $item;
});


return $collection;
    }


    //->groupBy('phone')

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show(int $id)
    {

        $info = Customer::with('repayableDues','orderPayments','repayableDues','repayablePayments')->findOrFail($id);
        $info->ordersRelation = $this->dataConverter($this->ordersRelation($id),OrdersRelationResource::class)->get();
        

       $info->payments = $this->dataConverter($info->orderPayments,OrderPaymentsResource::class)->sum(['amount'])->get();


        $info->repayableDues = $this->dataConverter($info->repayableDues,RepayableDuesResource::class)->sum(['dueAmount'])->get();
        

       $info->repayablePayments = $this->dataConverter($info->repayablePayments,RepayablePaymentsResource::class)->sum(['amount'])->get();


//return $info->ordersRelation[0];
        return $this->withView('pages.customerShow',compact('info'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function editCustomer(int $customerId): string
    {
    $info =  Customer::findOrFail($customerId);
    $info->tariffList = Tariff::select('id','name')->get();
    return $this->withView('pages.changeAndEditPage.editCustomer',['info'=>$info]);

    }

    /**
     * Update the specified resource in storage.
     *df
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */

    public function updateCustomer(editCustomer $request, int $customerId)
    {
        $customerID = $request->customerID;
        $customerName = $request->customerName;
        $customerPhone = $request->customerPhone;
        $tariffId = $request->tariffId;
        $city = $request->city??false;
        $customerNameConfrim = $request->customerNameConfrim ??false;
        $customerPhoneConfrim= $request->customerPhoneConfrim ??false;
        $customerTariffConfrim = $request->customerTariffConfrim ??false;
        $customerCityConfrim = $request->customerCityConfrim??false;
        $comment= $request->comment;
        //optionl

        if ($customerId ==$customerID):


                $data = [];
                if ($customerNameConfrim):
                    $data['name'] = $customerName;
                    endif;

                    if ($customerPhoneConfrim):
                        $data['phone'] = $customerPhone;
                        endif;

                    if ($customerTariffConfrim):
                        $data['tariff_id']=$tariffId;
                        endif;

                    if ($customerCityConfrim && $city):

                        $data['city']=$city;
                        endif;

                        if (count($data)):
                          Customer::where('id',$customerId)->update($data);
                              //->editCommentAdd($comment);

                        endif;

         else:

            throw new FormException('not valid Request');
             endif;



        return redirect()->route('customer.show',['id'=>$customerID])
            ->with('success', 'successfully! Update Customer');


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
