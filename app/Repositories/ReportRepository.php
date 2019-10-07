<?php


namespace App\Repositories;


use App\Exceptions\FetalException;
use App\Model\Customer;
use App\Model\Payment;
use Illuminate\Database\Eloquent\Collection;

class ReportRepository implements ReportRepositoryInterface
{


    protected $info;
    protected $model;
    protected  $subQurey = [];



    public function __construct()
    {
        $this->info = (object) [];
    }


    public function setInit(array $info){

        $this->info = (object) $info;
        return $this;


    }



    public function validInfo(string $propery) {



        return $this->info->{$propery} ?? false;

    }

    public function addVendor(){

        $kay = 'vendorid';
        $value = $this->validInfo($kay);
        $this->subQurey[$kay] = $value;

        return $this;

    }

    public function addFromDate(){

        $kay = 'fromDate';
        $value = $this->validInfo($kay);
        $this->subQurey[$kay] = $value;

        return $this;

    }

    public function addToDate(){

        $kay = 'toDate';
        $value = $this->validInfo($kay);
        $this->subQurey[$kay] = $value;

        return $this;


    }

    public function  addSerialTo(){
        $kay = 'serialTo';
        $value = $this->validInfo($kay);
        $this->subQurey[$kay] = $value;

        return $this;

    }
    public function  addSerialFrom(){
        $kay = 'serialFrom';
        $value = $this->validInfo($kay);
        $this->subQurey[$kay] = $value;

        return $this;


    }
    public function orderReport(){

        $this->model = Payment::orderReportQuery();

        return $this;

    }
    public function creditReport(){
        $this->model = Payment::VendorReportQuery()->Credits();

        return $this;

    }

    public function debitReport(){
        $this->model = Payment::VendorReportQuery()->Debits();

        return $this;
    }


    public function customerReport(){
        $this->model =   Payment::CustomerReportQuery();
        return $this;


    }

    public function customerReportMixer(Collection $collection){

        $collect=   $collection->map(function ($item,$key){
            $amount = $item->amount;
            $bill= $item->bill;
            $profit = $item->profit;
            $item->customers->first()->amount = $amount;
            $item->customers->first()->bill = $bill;
            $item->customers->first()->profit = $profit;
            return $item->customers->first();
        })->groupBy('phone')
            ->map(function ($item,$key){
                $name= $item->first()->name;
                $phone = $item->first()->phone;
                $pays = collect($item);
                $amount = $pays->sum('amount');
                $profit = $pays->sum('profit');
                $bill = $pays->sum('bill');

                return compact('name','phone','amount','profit','bill');


            })->values()->all();
        return $collect;
    }



    public  function combine(){

        if ($this->model){
            $pay = $this->model;
            $val = (object) $this->addVendor()->addFromDate()->addToDate()->addSerialFrom()->addSerialTo()->subQurey;


            if ($val->vendorid):
                $pay->vendorIs($val->vendorid);
            endif;
            if ($val->fromDate):
                $pay->fromDate($val->fromDate);
            endif;

            if ($val->toDate):
                $pay->toDate($val->toDate);
            endif;

            if ($val->serialFrom):
                $pay->serialFrom($val->serialFrom);
            endif;

            if ($val->serialTo):
                $pay->serialTo($val->serialTo);
            endif;




            return $pay;





        }else{

            throw new  FetalException('you not inisial model class');
        }

    }


    public function get(){ return $this->combine()->get();}
    public function find($id){ return $this->combine()->find($id);}
    public function findOrFail($id){ return $this->combine()->find($id);}
    public function paginate($val){ return $this->combine()->paginate($val);}

}