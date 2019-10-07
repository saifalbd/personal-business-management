<?php
namespace App\Http\Helper\deshboard;


use App\Model\Customer;
use App\Model\Payment;
use App\Model\Vendor;
use Illuminate\Support\Arr;
use Carbon\Carbon;

/**
 * 
 */
class vendorDetails
{
	
protected function vendorCount(){return Vendor::count();}
protected function vendorTotalCreditCount(){
	$result = [];
	foreach (Vendor::select('id')->withCount(['vendorCreditPayment'])->get() as $list) {
		array_push($result, $list->vendor_credit_payment_count);
	}
	
	return array_sum($result);
}

protected function vendorTotalDebitCount(){
	$result = [];
	foreach (Vendor::select('id')->withCount(['vendorDebitPayment'])->get() as $list) {
		array_push($result, $list->vendor_credit_payment_count);
	}
	
	return array_sum($result);
}

protected function vendorCreditTotal(){return Payment::Vendor_payment()->Credits()->sum('amount');}
protected function vendorDebitTotal(){return Payment::Vendor_payment()->Debits()->sum('amount');}
protected function vendorOrderTotal(){return Payment::Order_payment()->sum('amount');}
protected function vendorIHaveBalance(){
	return $this->vendorCreditTotal()-($this->vendorDebitTotal()+$this->vendorOrderTotal());
}

protected function VendorSingleDetails(){
$vendor = Vendor::Active()->with(
	['orderPayment:amount,created_at',
	'vendorCreditPayment:amount,created_at','vendorDebitPayment:amount,created_at'])->get();

$r = [];
foreach ($vendor as $list) {
$child =  [];

$child[0]['title']='order Pamynet Total';
$child[0]['value'] = array_sum(collect($list['orderPayment'])->pluck('amount')->all());

$child[1]['title']='Credit Payment Total'; 
$child[1]['value']  = array_sum(collect($list['vendorCreditPayment'])->pluck('amount')->all());

$child[2]['title']='Debit Payment Total';
$child[2]['value'] = array_sum(collect($list['vendorDebitPayment'])->pluck('amount')->all());

$child[3]['title']='Yesterday Debit Payment';
$child[3]['value'] = array_sum(collect($list['vendorDebitPayment'])->whereBetween('created_at',[Carbon::yesterday(),Carbon::today()])->pluck('amount')->all());

$child[4]['title']='Yesterday Credit Payment';
$child[4]['value'] = array_sum(collect($list['vendorCreditPayment'])->whereBetween('created_at',[Carbon::yesterday(),Carbon::today()])->pluck('amount')->all());

$child[5]['title']='Yesterday Order Payment';
$child[5]['value'] = array_sum(collect($list['orderPayment'])->whereBetween('created_at',[Carbon::yesterday(),Carbon::today()])->pluck('amount')->all());


$child[6]['title']='Today Debit Payment';
$child[6]['value'] = array_sum(collect($list['vendorDebitPayment'])->where('created_at','>=', Carbon::today())->pluck('amount')->all());

$child[7]['title']='Today Credit Payment';
$child[7]['value'] = array_sum(collect($list['vendorCreditPayment'])->where('created_at','>=', Carbon::today())->pluck('amount')->all());

$child[8]['title']='Today Order Payment';
$child[8]['value'] = array_sum(collect($list['orderPayment'])->where('created_at','>=', Carbon::today())->pluck('amount')->all());


$child[9]['title']='Current Month Debit Total';
$child[9]['value'] = array_sum(collect($list['vendorDebitPayment'])->where('created_at','>=', Carbon::today()->firstOfMonth())->pluck('amount')->all());

$child[10]['title']='Current Month Credit Total';
$child[10]['value'] = array_sum(collect($list['vendorCreditPayment'])->where('created_at','>=', Carbon::today()->firstOfMonth())->pluck('amount')->all());
$child[11]['title']='Current Month Order Total';
$child[11]['value'] = array_sum(collect($list['orderPayment'])->where('created_at','>=', Carbon::today()->firstOfMonth())->pluck('amount')->all());
$child[12]['title']='i have Balance';
$child[12]['value'] = $child[1]['value']-($child[0]['value']+$child[2]['value']);


 $list->child = $child;
unset($list->orderPayment);
unset($list->vendorCreditPayment);
unset($list->vendorDebitPayment);
array_push($r , $list);
};


return $r;
}


public function vendorSingleResult()
{
	return $this->VendorSingleDetails();
}
public function result()
{

	//return \Carbon\Carbon::now()->firstOfMonth();
	return [
		['title'=>'Total vendor','value'=>$this->vendorCount()],
		['title'=>'vendor Credit','value'=>$this->vendorTotalCreditCount()],
		['title'=>'vendor Credit Total','value'=>$this->vendorCreditTotal()],
		['title'=>'vendor Debit','value'=>$this->vendorTotalDebitCount()],
		['title'=>'vendor Debit Total','value'=>$this->vendorDebitTotal()],
		['title'=>'I have Balnce','value'=>$this->vendorIHaveBalance()],
		
		
	
	];
}

}