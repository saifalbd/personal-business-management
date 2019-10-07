<?php
namespace App\Http\Helper\deshboard;


use App\Model\Customer;
use App\Model\Payment;

/**
 * 
 */
class CustomerDetails
{
	
protected function customerCount(){return Customer::count();}
protected function customerOrderCount(){
$result = [];
	foreach (Customer::select('id')->withCount(['orders'])->get() as $list) {
		array_push($result, $list->orders_count);
	}
	return array_sum($result);
}

protected function customerOrderPaymentCount(){
return Payment::Order_payment()->count();
}
protected function customerOrderPaymentTotal(){return Payment::Order_payment()->sum('amount');}
protected function customerOrderPaymentSuccessTotal(){return Payment::Order_payment()->Active()->sum('amount');}
protected function customerOrderPaymentPendingTotal(){return Payment::Order_payment()->InActive()->sum('amount');}
protected function customerOrderPaymentTodayTotal(){return Payment::Order_payment()->today()->sum('amount');}

protected function customerOrderPaymentCurentMonthTotal(){return Payment::Order_payment()->CurrentMonth()->sum('amount');}


public function result()
{

	//return \Carbon\Carbon::now()->firstOfMonth();
	return [
		['title'=>'Total Customer','value'=>$this->customerCount()],
		['title'=>'Total number','value'=>$this->customerOrderCount()],
		['title'=>'Payment Records','value'=>$this->customerOrderPaymentCount()],
		['title'=>'Payment Total','value'=>$this->customerOrderPaymentTotal()],
		['title'=>'Payment Pending Total','value'=>$this->customerOrderPaymentPendingTotal()],
		['title'=>'Payment Success Total','value'=>$this->customerOrderPaymentSuccessTotal()],
		['title'=>'Curent Month Pyments','value'=>$this->customerOrderPaymentCurentMonthTotal()],
		['title'=>'Today Payment','value'=>$this->customerOrderPaymentTodayTotal()],
	
	];
}

}