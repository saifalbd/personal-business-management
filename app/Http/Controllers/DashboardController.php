<?php

namespace App\Http\Controllers;

use App\Model\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Http\Helper\deshboard\CustomerDetails;
use App\Http\Helper\deshboard\vendorDetails;
use Carbon\Carbon;

interface DashboardInterface
{	
	/**
	 * [totalCustomer description]
	 * @return [type] [string]
	 */
	public function totalCustomer();
}

class DashboardController extends Controller implements DashboardInterface
{
    
public function totalCustomer()
{ 
    return ['Customers', Customer::count()];
}



    public function index()
    {
//return Carbon::yesterday()->format('Y-m-d');
 $Customer = new CustomerDetails();
 $vendor = new vendorDetails();
$info = [
    'customerDetails'=>$Customer->result(),
    'vendorDetails'=>$vendor->result(),
    'vendorSingleDetails'=>$vendor->vendorSingleResult(),
];

   
    
       
 //return  $info;
       return $this->withView('pages.dashboardPage',['info'=> $info]);
        //;
    }

    
}
