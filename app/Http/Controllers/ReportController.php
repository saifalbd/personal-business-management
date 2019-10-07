<?php

namespace App\Http\Controllers;

use App\Exceptions\FlashMessage\Flash;
use App\Http\Helper\CustomModel\Model;
use App\Http\Helper\dropDown\VendorDrops;
use App\Http\Requests\ReportQuery;
use App\Http\Resources\report\{CreditReportResource,
    DebitReportResource,
    OrderReportResource,
    CustomerReportResource};
use App\Model\Vendor;
use Carbon\Carbon;
use App\Repositories\ReportRepositoryInterface;
use Illuminate\Http\Response;


class ReportController extends Controller
{

    protected $pay;
    protected  $vendorid;
    protected $vendor;
    protected $fromDate;
    protected $toDate;
    protected $serialFrom;
    protected $serialTo;



    public function __construct(ReportRepositoryInterface $pay)
    {

        $this->pay = $pay;
    }

    protected function makeSession($request , array $arr){

        foreach ($arr as $item=>$value) {

            Flash::input($item,$value);



}



}



    protected function getVendor()

    {

    return $this->vendorid?Vendor::find($this->vendorid) :(object)['name'=>null,'id'=>null];

    }

    protected function  setDetails($req =false):array
    {

        $request = $req??(object)[];


        $date = Carbon::now();
        $this->vendorid= $request->vendorid??false;
        $this->vendor= $this->getVendor();
        $this->toDate = $request->toDate??Carbon::now()->addDay(1)->format('Y-m-d');
        $this->fromDate = $request->fromDate??$date->subWeek()->format('Y-m-d');
        $this->serialFrom = $request->serialFrom??false;
        $this->serialTo = $request->serialTo??false;




$arr =  [
    'fromDate'=>$this->fromDate,
    'toDate'=>$this->toDate,
    'vendorid'=>$this->vendorid,
    'serialFrom'=>$this->serialFrom,
    'serialTo'=>$this->serialTo,
];

        $this->makeSession($request,$arr );
        return $arr;
    }



    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    protected function setOrderReport($request = false) {


        $pay = $this->pay->setInit($this->setDetails($request))->orderReport();

        $paymentList = $pay->get();
        $rowList =$this->dataConverter($paymentList,OrderReportResource::class)
            ->sum(['amount','profit'])->get();




        $info= (object) compact('rowList');

        $info->vendor =$this->vendor;
        $info->vendorDrops = VendorDrops::all();


        return $this->withView('pages.orderReport',['info'=>$info]);

    }


    protected function setCreditReport($req = false):string
    {
        $pay = $this->pay->setInit($this->setDetails($req))->creditReport();
        $paymentList = $pay->get();
        $rowList =$this->dataConverter($paymentList,CreditReportResource::class)->sum(['amount'])->get();
        $info= (object) compact('rowList');
        $info->vendor =$this->vendor;
        $info->vendorDrops = VendorDrops::all();


        return $this->withView('pages.creditReport',['info'=>$info]);

    }

    protected function setDebitReport($req = false) :string {

        $pay = $this->pay->setInit($this->setDetails($req))->debitReport();
        $paymentList = $pay->get();
        $rowList =$this->dataConverter($paymentList,DebitReportResource::class)->sum(['amount'])->get();
        $info= (object) compact('rowList');
        $info->vendor =$this->vendor;
        $info->vendorDrops = VendorDrops::all();


        return $this->withView('pages.debitReport',['info'=>$info]);
    }


    public function setCustomerReport($req = false){
        $pays = $this->pay->setInit($this->setDetails($req))->customerReport()->get();

        $mixer =  $this->pay->customerReportMixer($pays);


        $collection = Model::makeAll($mixer)->collection();
        //return $collection;
        $rowList = $this->dataConverter($collection,CustomerReportResource::class)->sum(['amount','profit','bill'])->get();




        $info= (object) compact('rowList');

        return $this->withView('pages.customerReport',['info'=>$info]);



    }

    public function customerReport(){

        return $this->setCustomerReport();
    }
    public function customerReportFilter(ReportQuery $request){

        return $this->setCustomerReport($request);
    }

    public function orderReportFilter(ReportQuery $request):string
    {
        return $this->setOrderReport($request);
    }

    public function orderReport():string
    {
        return $this->setOrderReport();
    }





    public function creditReport():string
    {
        return $this->setCreditReport();
    }

    public function creditReportFilter(ReportQuery $request):string
    {
        return $this->setCreditReport($request);
    }



    public function debitReport():string
    {

        return $this->setDebitReport();

    }

    public function debitReportFilter(ReportQuery $request){

        return $this->setDebitReport($request);
    }


}
