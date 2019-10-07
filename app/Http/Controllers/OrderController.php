<?php

namespace App\Http\Controllers;

use App\Exceptions\FlashMessage\Flash;
use App\Exceptions\FormException;
use App\Http\Requests\ChangeEdit\editOrder;
use App\Model\Order;
use App\Repositories\OrderRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OrderController extends Controller
{

    protected $order;

    public function __construct(OrderRepositoryInterface $order)
    {
      $this->order  = $order;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function editOrder(int $orderId)
    {

        $info = Order::findOrFail($orderId);

        return $this->withView('pages.changeAndEditPage.editOrder',['info'=>$info]);

    }

    public function editOrderUpdate(editOrder $request, int $orderId){

        $order = Order::findOrFail($orderId);
      $number = $request->number??false;
      $oldNumber = $request->oldNumber;
      $numberConfirm = $request->numberConfirm??false;
      $type = $request->type;
      $comment = $request->comment??false;
      $typeConfirm = $request->typeConfirm??false;
      $data = [];
      if ($numberConfirm){
          if ($number){
              $data['number'] = $number;
          }else{
              throw new FormException('new number are missing');
          }

          $data['oldNumber'] =$oldNumber;
      }
      if ($typeConfirm){
          $data['type'] = $type;
      }
      if (count($data)){
          $data['comment']= $comment;
          $this->order->updateOrder($data,$order);
      }else{
          throw new FormException('not are select any field number or type');
      }



      Flash::success('successFully Changed Number new number is '.$number);
      return redirect()->route('genaral.pending');
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
