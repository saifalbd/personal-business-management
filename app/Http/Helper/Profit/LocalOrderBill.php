<?php


namespace App\Http\Helper\Profit;


use App\Exceptions\FormException;
use App\Model\Customer;
use App\Model\Tariff;
use Illuminate\Support\Str;

class LocalOrderBill
{

    private $amount;
    private $customer;
    private $findBy = 'from';

    public function __construct(int $amount)
    {

        $this->amount = $amount;

    }



    private function dbRate(){

        if ($this->customer){
            $tariff = $this->customer->tariff->rates;
        }else{
            $tariff = Tariff::where('name','default')->first()->rates;
        }

        //dd($this->amount);
        if ($tariff && count($tariff)){
            $rate = $tariff->where($this->findBy,'>=',$this->amount)->first();

            if (!$rate) {

                $rate = $tariff->where($this->findBy,'<=',$this->amount)->first();

            }
            return $rate? $rate->withCharge/$rate->from:0;
        }else{
            throw new FormException('can not find any tariff Rates make frist default');
        }


    }

    public function withCustomer(Customer $customer){
        $this->customer = $customer;
        return $this;
    }

    private function makeBill(){
        $tableRate = $this->dbRate();
       // dd($tableRate*$this->amount);

        return $this->amount *$tableRate ;




    }


    public function getBill()
    {
        return round($this->makeBill(),2);
    }
}