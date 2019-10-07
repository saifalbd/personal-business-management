<?php

namespace App\Http\Controllers;

use App\Exceptions\FlashMessage\Flash;
use App\Http\Helper\Collection\DbCollection;
use App\Http\Helper\dropDown\DateDrops;
use App\Http\Helper\dropDown\VendorDrops;
use App\Model\Vendor;
use App\Repositories\PaymentRepositoryInterface;
use Illuminate\Http\Request;
use App\Model\Payment;
use Carbon\Carbon;
use App\Http\Requests\Api\PendingFinder;
use App\Http\Resources\Table\PendingResources;
use Illuminate\Http\Response;

class PendingController extends Controller
{

    protected $select = ['id','amount','bill','created_at'];
    protected  $payment;


    public function __construct(PaymentRepositoryInterface $payment)
    {
        $this->payment =$payment;
    }

    private function baseQuery(){
      return  Payment::select($this->select)->latest()->order_payment();
    }


    public function index(PendingFinder $request)
    {

        $this->pushTopMenu(['txt'=>'recent Active', 'link'=>route('history.recentActive')]);



        $pay =$this->baseQuery()->InActive();

$date = $request->date??false;
$vendorID = $request->vendorid??false;


$payment = $this->payment::builder($pay);
if ($date){

   $date =  Carbon::createFromFormat('Y-m-d', $date);

    $payment->dateIs($date);
}
if ($vendorID){
    $vendor = Vendor::findOrFail($vendorID);
    $payment->whereVendor($vendor);
}

$pay =  $payment->getBuild();
//return var_dump($pay);

$pay->with(['orders:id,number,type','customers:phone,name','vendors:name'])->WithComments();


if ($request->date) {
    Flash::set('date',$request->date);
    Flash::input('date',$request->date);
}
if ($request->vendorid) {

    Flash::input('vendorid',$request->date);
}



$payInfo =  $pay->get();


$dateDivider =    DateDrops::distance(collect($payInfo->toArray()));

$drops = VendorDrops::active();


        $rowList =  (new DbCollection($payInfo))
            ->resource(PendingResources::class)
            ->sum(['amount'])
            ->get();




$info =(object) compact('rowList','dateDivider','drops');
//return (array) $info ;

        return $this->withView('pages.pending',compact('info'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * @param $id
     */
   public function show($id){

   }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

/**
 * id is payment id
 */

    public function confirmDestroy($id)
    {
   $info =   Payment::with('orders')->findOrFail($id);
   //return $info;

       return $this->withView('pages.paymentRemovePage',['info'=>$info]);
      
       //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        return $id;
    }
}
