<?php


namespace App\Repositories;


use App\Exceptions\FetalException;
use App\Exceptions\FormException;
use App\Model\Customer;
use App\Model\Order;
use App\Model\Payment;
use App\Traits\AssociativeToObject;

class OrderRepository extends CustomerRepository implements OrderRepositoryInterface
{

    protected $order;

    /**
     * @param $number
     * @param string $type
     * @return mixed
     */
    private function existOrAdd($number,string $type){
        $order = Order::where('number',$number)->first();
        if (!$order){
            $order = Order::create(['number'=>$number,'type'=>$type]);
        }

        return $order;
    }

    private function canHasNumber(int $number):bool {
        $order = Order::where('number',$number)->first();

        return $order ?true:false;
    }

    private function getOldNumber(array $resource){
        $old = $resource['oldNumber']??false;

        if ($old):
            if (is_numeric($old)):
                $order = Order::where(['id'=>$resource['id'],'number'=>$old])->first();
            if ($order):
                return $order ;
                else:

                    throw  new FormException('oldNumber can not find in database Collections');
                    endif;
                else:
                throw  new FormException('oldNumber invalid Value');
                    endif;

            else:
            throw new FetalException('oldNumber Property or Value are missing');
                endif;
    }
    /**
     * @param Customer $customer
     * @throws FetalException
     */
    private function inheritCusomer(Customer $customer){

        if ($this->order){
            $hasCustomer =  $this->order->customers()->find($customer->id);
            if (!$hasCustomer){
                $this->order->customers()->attach($customer->id);
            }
        }else{
            throw new FetalException('order can not be empty');
        }



    }


    public function updateOrder(array $resource,Order $order){

        $resource['id']=$order->id;
        $number = $this->getNumber($resource,false);

        $type = $this->getType($resource);



        if ($number){

        if (!$this->canHasNumber($number) && $this->getOldNumber($resource)) {


            $order->number =$number;

            if ($type){
                $order->type =$type;
            }

            $order->save();




        }else {

            throw  new FormException('Number Alredy Exist');
        }
        }else if ($type){

            $order->type= $type;
            $order->save();
        }

        $comment = $this->getComment($resource);
        $this->comment($order,'edit:'.$comment);
        return $order;


    }

    /**
     * @param array $resource
     * @return array|mixed
     * @throws FetalException
     * @throws FormException
     *
     */
    protected function makeCustomerOrder(array $resource){
        $result = [];
        $number = $this->getNumber($resource,true);

        $type = $this->getType($resource);

        $comment = $this->getComment($resource);
        $customerResource = $this->getCustomer($resource,true);



        if ($customerResource){
            $order = $this->existOrAdd($number,$type);
            $this->order = $order;
            $customer =  $this->makeCustomer($customerResource);

            $this->inheritCusomer($customer);
            $result = $order;
            $result['customer']=$customer;

            if ($comment){
                $result['comment'] = $this->comment($order,$comment);
            }

        }




        return $result;

    }


    public function make(array $orderValues,array $payValues=[]){

       // return $this->orderAdd($orderValues,$payValues);
    }

}