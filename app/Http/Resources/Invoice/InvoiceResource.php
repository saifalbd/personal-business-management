<?php


namespace App\Http\Resources\Invoice;


use App\Exceptions\FetalException as Err;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
{

    private $dataIs = [];



    private function forVendor(){

        if (isset($this->vendor_id) && $this->vendor_id):
            $this->dataIs['name'] = $this->vendor->name;
            $this->dataIs['order_payment'] = $this->orderPaymentRes;

            $this->dataIs['credit_payment'] = $this->CreditPaymentRes;

            $this->dataIs['debit_payment'] = $this->debitPaymentRes;
        endif;
    }


    private function forCustomer(){

        if (isset($this->customer_id) && $this->customer_id):
            $this->dataIs['name'] = $this->customer->name;
            $this->dataIs['order_payment'] = $this->orderPaymentRes;

            $this->dataIs['credit_payment'] = $this->CreditPaymentRes;

            $this->dataIs['debit_payment'] = $this->debitPaymentRes;

        endif;
    }

    private function get(){
        $this->dataIs= [
            'vendor_id'=>$this->vendor_id,
            'customer_id'=>$this->customer_id,
            'invoice_id'=>$this->invoice_id,

        ];

        $this->forVendor();
        $this->forCustomer();

        return $this;
    }
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request = null)
    {

        $this->get();

        return $this->dataIs;
    }




    public function toJson(){

        return json_encode($this->toArray());
    }

    public function __isset($name)
    {
        isset($this->dataIs[$name]);
    }

    public function __unset($name)
    {

        unset($this->dataIs[$name]);
    }


    public function __get($name)
    {

        return $this->dataIs;

        if (array_key_exists($name,$this->dataIs)):


            return $this->dataIs[$name];


        else:

            throw new Err($name.' property not exists');
        endif;
    }

    public function __toString()
    {
        return  json_encode($this->toArray());
    }





}
