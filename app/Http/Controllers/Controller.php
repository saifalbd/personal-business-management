<?php

namespace App\Http\Controllers;

use App\Http\Helper\Collection\DbCollection;
use App\Model\Payment;
use Carbon\Carbon;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
public  $preventTime = '20 second';
protected static $addTopMenu =[];


    private function lastOrderLink(){
        $pay = Payment::Order_payment()->latest()->first();

        return $pay?route('request.show',['id'=>$pay->id]):'#';
    }

    private  function countPending(){
       return Payment::InActive()->order_payment()->count();
    }

   final protected function defaultLeftMenu()
    {
    	return [
    		[
    			'parent'=>'genaral',
    			'child'=>[
    				[
    				'icon'=>'mif-assignment fg-cyan',
    				'txt'=>'Dashboard',
    				'link'=>route('dashboard')
    				],
//                    [
//                        'icon'=>'mif-assignment fg-cyan',
//                        'txt'=>'Make Request',
//                        'link'=>route('request.create')
//                    ],
                    [
                        'icon'=>'mif-open-book fg-cyan',
                        'txt'=>'Create Order',
                        'link'=>route('request.wireTest')
                    ],
    				[
    				'icon'=>'mif-list2',
                        'counter'=>$this->countPending(),
    				'txt'=>'Pending Request',
    				'link'=>route('genaral.pending')
    				],
                    [
                        'icon'=>'mif-open-book fg-cyan',
                        'txt'=>'Latest Order',
                        'link'=>$this->lastOrderLink()
                    ],

    			]
    		],

    		[
    			'parent'=>'history',
    			'child'=>[
    				[
    				'icon'=>'mif-list2',
    				'txt'=>'Success List',
    				'link'=>route('history.success')
    				],
    				[
    				'icon'=>'mif-list2',
    				'txt'=>'Customer List',
    				'link'=>route('customer')
    				],

    			]
    		],
    		[
    			'parent'=>'Vendor',
    			'child'=>[
 
    				[
    				'icon'=>'mif-list2',
    				'txt'=>'Vendor List',
    				'link'=>route('vendor')
    				]
    			]
    		],
        [
                'parent'=>'Customer',
                'child'=>[
 
                    [
                    'icon'=>'mif-list2',
                    'txt'=>'Repayable Customers',
                    'link'=>route('repayable')
                    ]
                ]
            ],

            [
                'parent'=>'Tariff',
                'child'=>[

                    [
                        'icon'=>'mif-list2',
                        'txt'=>'Tarif List',
                        'link'=>route('tariff')
                    ],

                    [
                        'icon'=>'mif-add fg-cyan',
                        'txt'=>'Add Tarif',
                        'link'=>route('tariff.create')
                    ],
                ]
            ],

            [
                'parent'=>'Reports',
                'child'=>[
 
                    [
                    'icon'=>'mif-finder',
                    'txt'=>'Order Reports',
                    'link'=>route('report.order')
                    ],
                    [
                        'icon'=>'mif-finder',
                        'txt'=>'Customer Reports',
                        'link'=>route('report.customer')
                    ],

                    [
                    'icon'=>'mif-finder',
                    'txt'=>'Credit  Reports',
                    'link'=>route('report.credit')
                    ],
 
                    [
                    'icon'=>'mif-finder',
                    'txt'=>'Debit  Reports',
                    'link'=>route('report.debit')
                    ]
                ]
            ],
            [
                'parent'=>'options',
                'child'=>[
 
                    [
                    'icon'=>'mif-key',
                    'txt'=>'Layout Options',
                    'link'=>route('option',['params'=>'layout'])
                    ],
                    [
                    'icon'=>'mif-key',
                    'txt'=>'Repayable Options',
                    'link'=>route('option',['params'=>'repayable'])
                    ],
                     [
                    'icon'=>'mif-add fg-cyan',
                    'txt'=>'add Current Rate',
                    'link'=>route('rate.bankRate.create')
                    ],
                    
                ]
            ],

    	];
    }

    public function pushTopMenu(array $data){
        array_push(static::$addTopMenu,$data);
    }
   final protected function defaultTopMenu()
    {
    	$menu = [
    		[
    		'txt'=>'home',
    		'link'=>route('home')
    		],


    	];
    	if (count(static::$addTopMenu)){
    	    foreach (static::$addTopMenu as $list){
                array_push($menu,$list);
            }
        }

    	return $menu;
    }

   final public function withView($viewPath,$data=[])
    {


    	if (count($data)) {

        

    	if (!isset($data['leftMenu'])) {

    	$data['leftMenu'] =$this->defaultLeftMenu();
         
    	}
    	if (!isset($data['topMenu'])) {
    	$data['topMenu'] = $this->defaultTopMenu();
        
    	}
    	}else{
    	$data = [];
    	$data['leftMenu'] = $this->defaultLeftMenu();
    	$data['topMenu'] = $this->defaultTopMenu();
    	}
$data['leftMenu'] = json_encode($data['leftMenu']);
$data['topMenu'] = collect($data['topMenu'])->toJson();


    	return view($viewPath,$data);
    }



/**
 * [preventEntry description]
 * @param  [type] $model [description]
 * @param  [type] $arr   [description]
 * @param  string $time  [
 * and so on for any unit: millenium, century, decade, year, quarter, month, week, day, weekday,
 hour, minute, second, microsecond.
 example :  2 hour , 5 minute, 50 second ]
 * @return [type]        [description]
 */
  final public function preventEntry($model,$arr=false,$time = '5 minute')
    {
    $before = Carbon::now()->sub($this->preventTime);
$findDate = $model::where('created_at', '>=',$before)->first();
if (!$findDate) {
$dt = Carbon::now();

 $date =  $dt->sub($time)->format('Y-m-d H:i:s');

 
      $find =  $model::where($arr)->where('created_at', '>=',$date)->first();
      

      if ($find) {
   $error =['duplicat Entry wait '.$dt->diffInMinutes($find->created_at)];
 
      return redirect()->back()->withErrors( $error);
      }else{
    return false;
      }
  }else{
  $error = ['wait '.$this->preventTime];
   
    return redirect()->back()->withErrors($error);
  }
   
    }

    public function dataConverter($info,$resource):DbCollection
    {

        //return $info;;

        $data =   (new DbCollection($info))
            ->resource($resource);

        return $data;

    }
}
