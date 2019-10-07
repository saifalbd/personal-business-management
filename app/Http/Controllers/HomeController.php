<?php

namespace App\Http\Controllers;

use App\Http\Helper\dropDown\VendorDrops;
use App\Model\Payment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HomeController extends Controller
{


    protected function topMenu()
    {
        return [
            [
            'txt'=>'home',
            'link'=>route('home')
            ],
            [
             'txt'=>'Pending'. Payment::InActive()->order_payment()->count(),
            'link'=>route('genaral.pending')
            ],
            [
           'txt'=>'Success List',
            'link'=>route('history.success')   
            ],
            [
           'txt'=>'Customer List',
            'link'=>route('customer') 
            ],
            [
            'txt'=>'Vendor List',
             'link'=>route('vendor')

            ]

        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
    $vendors = VendorDrops::active();
   if (count($vendors)) {
       $info = ['vendors'=> $vendors];
       return $this->withView('pages.index',
        ['info'=>$info,
        'topMenu'=>$this->topMenu()]
    ); 
   }else{
    return redirect()->route('vendor');
   }
   

    }
    public function wireTest()
    {
        $vendors = VendorDrops::active();
        if (count($vendors)) {
            $info = ['vendors'=> $vendors->toJson()];

            return $this->withView('pages.testPage',
                ['info'=>$info,
                    'topMenu'=>$this->topMenu()]
            );
        }else{
            return redirect()->route('vendor');
        }


    }

    /**
     p* Show the form for creating a new resource.
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
