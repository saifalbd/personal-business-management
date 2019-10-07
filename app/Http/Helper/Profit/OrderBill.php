<?php


namespace App\Http\Helper\Profit;


use App\Exceptions\FormException;
use App\Model\Customer;
use App\Model\Rate;
use App\Model\Tariff;
use App\Repositories\TariffRepository;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use LogicException;

class OrderBill
{

    private $amount;
    private $customer;
    private $findBy = 'withCharge';

    /**
     * @var boolean
     * is true $this->getBill() return Local amount otherwise return foreign amount
     */
    public $isLocal;

    public function __construct(int $amount)
    {


        $this->amount = $amount;

    }

    /**
     * @param string $type is
     * config('currency.localSymbol') final result is foreign Money  otherwise return local Money
     * @return $this
     *
     */
    public function currencyType(string $type){
        $symbols = [config('currency.localSymbol'),config('currency.foreignSymbol')];
        $symbols =  collect($symbols)->map(function ($item,$key){return trim($item);})->all();
        if (in_array($type,$symbols)){

            if (Str::is($type,trim(config('currency.localSymbol')))):
                $this->isLocal = true;
                $this->findBy = 'from';
                endif;

        }else{
            throw new LogicException('type must be'.collect($symbols)->toJson());
        }
        return $this;
    }

    private function dbRate(){

       if ($this->customer){
           $tariff = $this->customer->tariff;
       }else{
           $tariff = (new TariffRepository())->getDefault();
       }


       if ($tariff){

           $rate = $tariff->rates()->orderBy($this->findBy,'asc')->where($this->findBy,'>=',$this->amount)->first();

           if (!$rate) {
            $rate = $tariff->rates()->orderBy($this->findBy,'asc')->where($this->findBy,'<=',$this->amount)->first();

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


        return $this->isLocal? $this->amount*$tableRate: $this->amount /$tableRate ;




    }


    public function getBill()
    {

       return round($this->makeBill(),2);
    }

}