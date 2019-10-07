<?php

namespace App\Http\Controllers;

use App\Exceptions\FormException;

use App\Http\Requests\Invoice\InvoiceGenarate;
use App\Model\Invoice;
use Carbon\Carbon;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use PDF;
use phpDocumentor\Reflection\Types\Boolean;
use App\Repositories\InvoiceRepository;
use stdClass;


class InvoiceController extends Controller
{
    protected $invoice;

    public function __construct(InvoiceRepository $invoice)
    {
        $this->invoice = $invoice;
    }




//http://hisabnikash.demo/vendors/1/show

    protected function canAttach($invoice, $payId)
    {

        $pay = $invoice->payments()->find($payId);


        return $pay;

    }

    protected function createInvoice(stdClass $arg)
    {
        //string $role,int $parent_id ,int $invoice_id,int $stock

        $parent = $arg->parent . '_id';


        $arr = [

            'invoice_id' => $arg->invoice_id,
            'stock' => $arg->stock,
            'start_time' => Carbon::now(),
            'end_time' => Carbon::now()
        ];
        $arr[$parent] = $arg->parent_id;


        return Invoice::create($arr);
    }

    protected function getPrevInvoiceInfo(string $role, int $_id): stdClass
    {

        $parent = $role . '_id';


        // $in = Invoice::where($parent,$_id)->latest()->first();
        $in = Invoice::where($parent, $_id)->where('publish', 0)->latest()->first();

        $finder = $in;

        $invoice_id = $in ? $in->invoice_id + 1 : 1;
        $invoice_stock = $in ? $in->stock : 0;

        return (object)compact('invoice_id', 'invoice_stock', 'finder');

    }

    protected function genarateVendorInvoice(int $_id, string $parent)
    {


        $prevInfo = $this->getPrevInvoiceInfo($parent, $_id);

        $arg = (object)[
            'parent' => $parent,
            'parent_id' => $_id,
            'invoice_id' => $prevInfo->invoice_id,
            'stock' => $prevInfo->invoice_stock
        ];

        return $prevInfo->finder ?? $this->createInvoice($arg);


    }

    public function genarate(InvoiceGenarate $request)
    {


        $obj = $this->genarateVendorInvoice($request->_id, $request->parent);

        return redirect()->route('invoice.show', ['type'=>$request->parent,'id' => $obj->id]);
    }


    public function show(string $type,int $id)
    {

        $info =  $this->invoice->show($type,$id);


       //return $info->OldStock;

      // return  $info->creditPaymentRes;
        //return collect($info->toArray())->keys();



        return $this->withView('pages.invoiceShow', compact('info'));
    }

    public function publish(Request $request){

        $invoiceId = $request->invoiceId??false;

        if (!$invoiceId){
            throw new FormException('invoice id is missing');
        }
        $balance = $request->balance??false;
        if (!$balance){
            throw new FormException('balance is missing');
        }

        $invoice = Invoice::findOrFail($invoiceId);
       $invoice->publish = true;
       $invoice->stock=$balance;
       $invoice->save();

       return redirect()->back();
      // return $invoice;

    }

    /**
     * @param string $type 'customer || vendor'
     * @param int $id if $type is customer vendor then vendor_id els can $type customer then customer id
     * @param int $payId payment id
     * @param Boolean $role is true then attach else detach
     * @return bool
     */
    protected function pushPull(string $type, int $id, int $payId, Bool $role)
    {

        $info = $this->getPrevInvoiceInfo($type, $id);


        $invoice = $info->finder;



        $can = $this->canAttach($invoice, $payId);




        if ($invoice) {

            if ($role && !$can) {
                $invoice->payments()->attach($payId);
            } else if (!$role && $can) {
                $invoice->payments()->detach($payId);
            }

            return redirect()->back()->with('success', 'IT WORKS!');

        }

        throw new FormException('some error');

    }


    /**
     * @param string $type 'customer || vendor'
     * @param int $id if $type is customer vendor then vendor_id els can $type customer then customer id
     * @param int $payId payment id
     * @return bool
     * @throws FormException
     */
    public function pushPayment(string $type, int $id, int $payId)
    {


        return $this->pushPull($type, $id, $payId, true);

    }

    /**
     * @param string $type 'customer || vendor'
     * @param int $id if $type is customer vendor then vendor_id els can $type customer then customer id
     * @param int $payId payment id
     * @return bool
     * @throws FormException
     */

    public function pullPayment(string $type, int $id, int $payId)
    {

        return $this->pushPull($type, $id, $payId, false);

    }


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function generatePDF(string $type,int $id)
    {

        $info =  $this->invoice->show($type,$id);

        $info->pdf = true;




        return $this->withView('pages.invoicePdfHtml', compact('info'));


    }

    public function downLoadPdf(string $type,int $id){
        $data = ['title' => 'Welcome to HDTuto.com'];
        $pdf = PDF::loadView('pages.invoicePdfHtml', $data);

        return $pdf->download('itsolutionstuff.pdf');

    }


}