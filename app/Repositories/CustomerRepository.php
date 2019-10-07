<?php


namespace App\Repositories;

use App\Exceptions\FetalException;
use App\Exceptions\FormException;
use App\Model\Customer;
use App\Model\Order;
use App\Model\Payment;
use App\Traits\MagicAdd;
use phpDocumentor\Reflection\Types\Integer;
use stdClass;

class CustomerRepository extends FieldsValidations implements CustomerRepositoryInterface
{

    protected $defaultTarifId = 1;
    private $currentCustomer;
    private $data = [];


    /**
     * @param string $comment
     * @param string $type
     */
    final protected function comment($parent,string $comment,string $type="peyment"){


        $info = ['type'=>$type,'body'=>$comment];
        $this->data['comments']= $parent->comments()->Create($info);


        return $this->data['comments'];
    }

    /**
     * @param array $arg
     * @return mixed
     * @throws FetalException
     * @throws FormException
     */

    public  function makeCustomer(array $arg){


        $name = $this->getName($arg);
        $phone = $this->getPhone($arg);
        $city = $this->getCity($arg);
        $tariff_id = $this->getTariffId($arg);
        $comment = $this->getComment($arg);

        $data = compact('name','phone','tariff_id');
        if ($city){$data['city'] = $city;}

        $customer = Customer::where('phone',$data['phone'])->first();

        if (!$customer){

            $customer = Customer::create($data);
        }

        $this->currentCustomer = $customer;
        $this->data =  $customer;

        if ($comment){
            $this->comment($customer,$comment);
        }

        return $customer;

    }



    /**
     * @param Customer $customer
     * @param Order $order
     */
    public function inheritOrder(Customer $customer,Order $order){


       $hasOrder =  $customer->orders()->find($order->id);
       if (!$hasOrder){
           $customer->orders()->attach($order->id);
       }

    }

public function initCustomer($name,$phone){
      $customer =   Customer::firstOrCreate(
          ['phone' => $phone],
          ['name' => $name,'city'=>null]

      );
    return $customer;
}





    public function toArray(){
        return $this->data;
    }
use MagicAdd;

}