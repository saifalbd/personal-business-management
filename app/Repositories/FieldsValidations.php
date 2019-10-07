<?php


namespace App\Repositories;

use App\Exceptions\FormException;
use App\Exceptions\FetalException;
use App\Model\Tariff;


class FieldsValidations implements FieldsValidationsInterface
{

    protected $customerKey = 'customer';
    protected $orderKey = 'order';
    protected $paymentKey = 'payment';
    protected $commentKey = 'comments';
    protected $vendorKey = 'vendor';

    public function getName(array $arg):string {
        $data =(object) $arg;
        if (isset($data->name)):
            if (is_string($data->name)):
                return $data->name;
            else:

                throw new FormException('propery name value not are string');


            endif;

        else:

            throw new FetalException('propery name are missing');


        endif;


    }
    public function getPhone(array $arg)
    {
        $phone= 0;
        $data =(object) $arg;
        if (isset($data->phone)):
            if (!is_nan($data->phone)):
                $phone = $data->phone;
            else:

                throw new FetalException('propery phone value not are number');

            endif;
        else:
            throw new FetalException('propery phone are missing');
        endif;

        return $phone;
    }

    public function getNumber(array $arg,bool $prevent=false){

        $number= 0;
        $data =(object) $arg;
        if (isset($data->number)):
            if (!is_nan($data->number)):
                $number = $data->number;
            else:

                throw new FetalException('propery number value not are number');

            endif;
        else:
            if ($prevent){
                throw new FetalException('propery number are missing');
            }

            return false;
        endif;

        return $number;

    }

    public function getCity(array $arg,bool $prevent=false){
        $data =(object) $arg;
        if (isset($data->city)):
            if (is_string($data->city)):
                return $data->city;
            else:
                throw new FormException('propery name value not are string');

            endif;

        else:

            if ($prevent){throw new FormException('propery city are missig'); }

            return false;


        endif;

    }

    public function getComment(array $arg,bool $prevent=false){
        $data =(object) $arg;
        if (isset($data->comment)):
            if (is_string($data->comment)):
                return $data->comment;
            else:
                throw new FormException('propery comment value not are string');

            endif;

        else:

            if ($prevent){throw new FormException('propery commen are missig'); }

            return false;


        endif;
    }



    public function getTariffId(array $arg){
        $data =(object) $arg;
        if (isset($data->tariffId)):
            if (!is_nan($data->tariffId)):

                $tariff_id = $data->tariffId;


            else:

                throw new FetalException('propery tariff_id value not are number');

            endif;
        else:

            $tariff_id = $this->defaultTarifId;

        endif;

        $tariff = Tariff::find($tariff_id);

        if ($tariff):
            return $tariff->id;
        else:
            throw  new FormException('tarif not found please make tarif first');
            return false;
        endif;




    }

    public function getAmount(array $arg){
        $amount= 0;
        $data =(object) $arg;
        if (isset($data->amount)):
            if (!is_nan($data->amount)):
                $amount = $data->amount;
            else:

                throw new FetalException('propery amount value not are number');

            endif;
        else:
            throw new FetalException('propery amount are missing');
        endif;

        return $amount;

    }

    public function getType(array $arg){
        $data =(object) $arg;
        if (isset($data->type)):
            if (is_string($data->type)):
                return $data->type;
            else:
                throw new FormException('propery type value not are string');

            endif;

        else:

            throw new FetalException('propery type are missing');


        endif;
    }

    public function getProfit(array $arg,bool $prevent=false){
        $data =(object) $arg;
        if (isset($data->profit)):
            if (is_int($data->profit)):
                return $data->profit;
            else:
                //throw new \LogicException('propery profit value not are int');

               throw new FormException('propery profit value not are int');

            endif;

        else:

            if ($prevent){throw new FormException('propery profit are missig'); }

            return 0;

        endif;
    }


    public function getBill(array $arg,bool $prevent=false){
        $data =(object) $arg;
        if (isset($data->bill)):
            if (is_numeric($data->bill)):
                return $data->bill;
            else:
                throw new FormException('propery bill value not are int');

            endif;

        else:

            if ($prevent){

                throw new FormException('propery bill are missig');
            }

            return 0;

        endif;
    }



    public function getCustomer(array $resource,bool $prevent=false){

        if (count($resource)):

            if (isset($resource[$this->customerKey])):
                return $resource[$this->customerKey];

            endif;

            if ($prevent){

                throw new FormException('propery '.$this->customerKey.' are missig');
            }
            return false;

            else:
                throw new FetalException('arg Array can not be Empty');
        endif;



    }

    public function getOrder(array $resource,bool $prevent=false){


        if (count($resource)):


            if (isset($resource[$this->orderKey])):

                return $resource[$this->orderKey];

            else:

                if ($prevent){

                    throw new FormException('propery '.$this->orderKey.' are missig');
                }
                return false;


            endif;


        else:
            throw new FetalException('arg Array can not be Empty');
        endif;

    }

    public function getVendor(array $resource,bool $prevent=false){

        if (count($resource)):


            if (isset($resource[$this->vendorKey])):

                return $resource[$this->vendorKey];

            else:

                if ($prevent){

                    throw new FormException('propery '.$this->vendorKey.' are missig');
                }
                return false;


            endif;


        else:
            throw new FetalException('arg Array can not be Empty');
        endif;
    }



}