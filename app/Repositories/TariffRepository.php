<?php


namespace App\Repositories;


use App\Exceptions\FormException;
use App\Model\Tariff;

class TariffRepository implements TariffRepositoryInterface
{

    private $tariff;
    private  $defaultTariffId;

    public function __construct()
    {
        $this->defaultTariffId = 1;
    }


    private function canCustomer(){

        return count($this->tariff->customers);
    }

    protected function removeRates(){

        if ($this->canRates()){
            collect($this->tariff->rates)->each(function ($item,$key){
                $item->forceDelete();
            });
        }

        return $this;
    }
    private function removeTariff(){

        $tt = Tariff::findOrFail($this->tariff->id);
        $tt->forceDelete();
        return $this;

    }
    public function getDefault():Tariff{
      return  Tariff::findOrFail($this->defaultTariffId);
    }
    public function model(Tariff $tariff)
    {
        $this->tariff = $tariff;
        return $this;
    }



    public function canRates():bool
    {
        return count($this->tariff->rates);
    }

    public function hasTariff(int $id):bool {
        return Tariff::find($id);
    }

    public function forSelect()
    {
      return  Tariff::select('id','name')->get();
    }



    public function remove(int $id)
    {
        $this->tariff = Tariff::findOrFail($id);

        if ($this->canCustomer()){

            throw new FormException('this tariff has child remove this from child then try');

        }else{

            $this->removeRates()->removeTariff();

        }


        return true;
    }

}