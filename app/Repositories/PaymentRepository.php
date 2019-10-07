<?php


namespace App\Repositories;
use App\Exceptions\FetalException;
use App\Exceptions\FormException;
use App\Http\Helper\Profit\ProfitMaker;
use App\Model\Customer;
use App\Model\Order;
use App\Model\Payment;
use App\Model\Vendor;
use App\Http\Helper\Profit\OrderBill;
use App\Traits\MagicAdd;
use Carbon\Carbon;
use http\Exception\InvalidArgumentException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\App;
use phpDocumentor\Reflection\Types\Resource_;


class PaymentRepository extends OrderRepository implements PaymentRepositoryInterface
{


    protected $data = [];

    protected $currentPayment;
    protected $builder;


    private function appendVendor(Vendor $vendor){

        if ($this->currentPayment) {
            $hasCustomer = $this->currentPayment->vendors()->find($vendor->id);
            if (!$hasCustomer) {
                $this->currentPayment->vendors()->attach($vendor->id);
            }
        } else {
            throw new FetalException('$this->currentPayment can not be empty');
        }

    }

    private function appendCusomer(Customer $customer)
    {

        if ($this->currentPayment) {
            $hasCustomer = $this->currentPayment->customers()->find($customer->id);
            if (!$hasCustomer) {
                $this->currentPayment->customers()->attach($customer->id);
            }
        } else {
            throw new FetalException('currentPayment can not be empty');
        }

    }

    /**
     * @param Order $order
     * @throws FetalException
     */
    private function appendOrder(Order $order)
    {


        if ($this->currentPayment) {
            $hasOrder = $this->currentPayment->orders()->find($order->id);
            if (!$hasOrder) {
                $this->currentPayment->orders()->attach($order->id);
            }
        } else {
            throw new FetalException('$this->data can not be empty');
        }

    }
        /**
     * @param array $arg
     * @return mixed
     * @throws FetalException
     */
    private function payment(array $arg){


        if (config('view.showRequest')){

            $pay = Payment::Create($arg);
        }else{

            dd([$arg,'check config.view.showRequest']);
            return 'test mode';
        }



            $this->currentPayment= $pay;
        return $pay;



    }

    public function makeProfit(Payment $payment,Vendor $vendor,int $bill){
        $obj =(object) ['customerCost'=> $payment->bill,
            'vendor'=>$vendor->id,
            'amount'=>$payment->amount];
        $profit =new ProfitMaker($obj);
        return $profit->result();
    }

    private function billProfitUpdate(Customer $customer,Vendor $vendor){

        $pay = $this->currentPayment;
        if ($pay){

            if (!$pay->bill){
                $pay->bill = (new OrderBill($pay->amount))->withCustomer($customer)->getBill();
            }

            $pay->profit = $this->makeProfit($pay,$vendor,$pay->bill);

            if ($pay->bill){
                $pay->save();
            }

            return $pay;

        }
        else {

        throw new FetalException('$this->data can not be empty');
        }

return $pay;
}


    /**
     * @param array $arg
     * @return mixed
     * @throws FetalException
     * @throws FormException
     */
    private function addOrderPayments(array $arg){

        $paytype = 'debit';
        $amount = $this->getAmount($arg);
        $profit = $this->getProfit($arg,false);
        $bill = $this->getBill($arg,false);
        $data = compact('name','amount','paytype','profit','bill');

        $pay = $this->payment($data);

        if ($this->getComment($arg)){
            $this->comment($this->currentPayment,$this->getComment($arg));
        }

        return $pay;

    }


    /**
     * @param Builder $builder
     * @return PaymentRepository
     */
    public static function builder(Builder $builder){

        $x = new static;
        $x->builder = $builder;

        return $x;

    }

    /**
     * @param int $id
     * @return $this
     */
    public function idFrom(int $id){
        $this->builder->where('id','>=',$id);
        return $this;
    }

    /**
     * @param int $id
     * @return $this
     */
    public function idTo(int $id){
        $this->builder->where('id','<=',$id);
        return $this;
    }

    /**
     * @param Carbon $carbon
     * @return $this
     */
    public function dateFrom(Carbon $carbon){
        $this->builder->where('created_at','>=',$carbon);
        return $this;

    }

    /**
     * @param Carbon $carbon
     * @return $this
     */
    public function dateTo(Carbon $carbon){
        $this->builder->where('created_at','<=',$carbon);
        return $this;
    }

    /**
     * @param Carbon $carbon
     * @return $this
     */
    public function dateIs(Carbon $carbon){
        $this->builder->where('created_at','like','%'.$carbon->toDateString().'%');
        return $this;
    }


    /**
     * @param Vendor $vendor
     * @return $this
     */
    public function whereVendor(Vendor $vendor)
    {

        $this->builder->whereHas('vendors', function ($query) use($vendor) {
            $query->where('id',$vendor->id);
        });
        return $this;
    }
    public function getBuild():Builder{
        if ($this->builder){
            return $this->builder;
        }else{
            throw new  \InvalidArgumentException('bulider not found');
        }

    }



    public function updateOrderPayment(Payment $payment,int $amount,int $bill=null)
    {
        $customer = $payment->customers()->first();
        $vendor= $payment->vendors()->first();
        $bill = $bill?? (new OrderBill($amount))->withCustomer($customer)->getBill();


        $profit = (new ProfitMaker((object)['customerCost'=> $bill,
            'vendor'=>$vendor->id,
            'amount'=>$amount]))->result();

        $payment->amount = $amount;
        $payment->profit = $profit;
        $payment->bill = $bill;


        $payment->save();

        return $payment;


    }

    /**
     * @param array $arg
     * @return mixed
     * @throws FetalException
     * @throws FormException
     */
    public function makeOrderPayment(array $resource){

        $result = [];
        $order = $this->getOrder($resource,true);

        $customer = $this->getCustomer($resource,true);
        $comment = $this->getComment($resource);
        $vendorID = $this->getVendor($resource,true);



        if ($order&&$customer){
          $pay =  $this->addOrderPayments($resource);

          if ($comment){$this->comment($pay,$comment);}

          $order[$this->customerKey] = $customer;
          $orderData =  $this->makeCustomerOrder($order);


          $this->appendOrder($orderData);
          $this->appendCusomer($orderData[$this->customerKey]);



           $vendor =  Vendor::findOrFail($vendorID);

            $result = $this->billProfitUpdate($orderData[$this->customerKey],$vendor);

            $result[$this->orderKey] = $orderData;

            $this->appendVendor($vendor);
              $result[$this->vendorKey]=$vendor;



        }


        return $result;

    }

    public function changeVendor(array $resource){
        $paymentId = $resource['paymentId'];
        $customerId = $resource['customerId'];
        $vendorId = $resource['vendorId'];
        $comment = $this->getComment($resource,false);
        $this->currentPayment = Payment::findOrFail($paymentId);
        $customer = Customer::findOrFail($customerId);
        $vendor = Vendor::findOrFail($vendorId);
        $pay = $this->billProfitUpdate($customer,$vendor);
        $pay->vendors()->sync([$vendor->id]);

        if ($comment){
            $this->comment($pay,$comment,'change');
        }

        return $pay;

    }
    public function doVendorCredit(array $arg){

    }
    public function doVendorDebit(array $arg){

    }


}