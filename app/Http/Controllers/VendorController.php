<?php

namespace App\Http\Controllers;

use App\Repositories\InvoiceRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Requests\VendorCreate;
use App\Http\Requests\VendorPayment;
use App\Http\Requests\ChangeEdit\editVendor;
use App\Model\Vendor;
use App\Model\Payment;
use App\Http\Resources\Vendor\{OrderPaymentResource,CreditPaymentResource,DreditPaymentResource};

use Illuminate\Http\Response;

class VendorController extends Controller
{


    protected $invoice;
    public function __construct(InvoiceRepositoryInterface $invoice)
    {
        $this->invoice = $invoice;
    }


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $vendors = Vendor::all();

        /**
         * with(
        ['vendorCreditPayment',
        'vendorDebitPayment'
        ])->get();
         */

       // return $vendors;

        //return $vendors->creditPaymentRes;



        return $this->withView('pages.vendor',['rowList'=>$vendors]);
    }

    /**+
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return $this->withView('pages.vendorCreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(VendorCreate $request)
    {
    $vendorName = $request->vendorName;

    $prevent = $this->preventEntry(Vendor::class,['name'=>$vendorName],'1 minute');
    if ($prevent) {
        return $prevent;
    }else {
       $vendor =   Vendor::Create(['type'=>$request->vendorType,'name'=>$request->vendorName])->ExHistory()->Create(['ex_rate'=>$request->vendorRate]);
    }

    return redirect()->route('vendor')
    ->with('success', 'successfully! Create Vendor');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
     $info = Vendor::forgotType('invoice')->with([
        'orderPayment',
       'vendorCreditPayment',
       'vendorDebitPayment'
    ])->findOrFail($id);

//return $info->publishedInvoice()->with('orderPayment')->get();



$info->orderPayment = $this->dataConverter($info->orderPayment,OrderPaymentResource::class)->sum(['amount'])->get();

$info->vendorCreditPayment = $this->dataConverter($info->vendorCreditPayment,CreditPaymentResource::class)->sum(['amount'])->get();

$info->vendorDebitPayment = $this->dataConverter($info->vendorDebitPayment,DreditPaymentResource::class)->sum(['amount'])->get();





    //return $vendor->orderPayment;
       return $this->withView('pages.vendorshow',compact('info'));

    }

    public function payment(VendorPayment $req, $id)
    {

    $comment = $req->description??false;
    $date =(object) getdate(date("U"));
    $hours = $date->hours;
    $minutes = $date->minutes;
    $seconds = $date->seconds;


    $date = $req->date.' '.$hours.':'.$minutes.':'.$seconds;


    if($req->amountType =='prepaid'){
    $amount = $req->amount;
    }else if($req->amountType =='return'){
    $amount =  $req->amount * -1; // = -123
    }


    $pay = Payment::Create(
        [
            'paytype'=>$req->paymentType,
            'amount'=>$amount,
            'created_at'=>$date,
            'updated_at'=>$date
        ]);


        $pay->vendors()->attach($id);
    if ($comment) {$pay->createCommentAdd($comment);}

     return redirect()->route('vendor')
     ->with('success', 'successfully! Insert Vendor Payment');


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function editVendor($vendorId)
    {
    $vendor = Vendor::findOrFail($vendorId);
    return $this->withView('pages.changeAndEditPage.editVendor',['info'=>$vendor]); 
    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function editVendorUpdate(editVendor $request, $vendorId)
    {
        $vendorID = $request->vendorID;
        $vendorName = $request->vendorName;
        $vendorRate = $request->vendorRate;
        $vendorNameConfrim = $request->vendorNameConfrim;
        $vendorRateConfrim = $request->vendorRateConfrim;
        $vendorType = $request->vendorType;
        $active = $request->active;
        $comment= $request->comment;

        $vendor = Vendor::findOrFail($vendorId);
//!Vendor::Name($vendorName)->first()
        if (isset($vendorNameConfrim) ) {
Validator::make(
    ['name'=>$vendorName], ['name' =>'unique:Vendors'],
    ['unique'=>'Vendor Name Alredy Available']
)->validate();

          $vendor->name = $vendorName;
          
        }
        if (isset($vendorRateConfrim)) {
            
           $ExHistory = $vendor->ExHistory()->first();
           $ExHistory->ex_rate = $vendorRate;
           $ExHistory->save();
         
        }
       
        $vendor->type = $vendorType;
        $vendor->active = $active;

       $vendor->save();
       if (isset($comment) && $comment) {
          $vendor->editCommentAdd($request->comment);
          

       }
       return redirect()->route('vendor')
       ->with('success', 'successfully! Update Vendor');;
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
