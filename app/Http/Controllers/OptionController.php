<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\OptionStoreRepayable;
use App\Http\Requests\optionsRemove;
use App\Model\Option;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;

class OptionController extends Controller
{
    
 /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($params)
    {
    	$info = [];
    	$info['pageTitle'] = 'Repayable';
    	$info['slug'] = $params;
      
      $info['option'] = Option::where('group_name',$params)->get(); 
        
    	

        

    	
        return $this->withView('pages.option',['info'=>$info]);
    }
  

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(RateCreate $request)
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function storeRepayable(OptionStoreRepayable $request)
    {
    	Option::updateOrCreate(
    ['group_name' =>$request->groupName, 'option_name' =>$request->optionName],
    ['option_value' =>$request->optionValue]);

return redirect()->back()
->with('success', 'successfully! Create Rate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store2(RateCreate $request)
    {

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
    public function destroy(optionsRemove $request)
    {
      
     $idarr =  Arr::pluck(json_decode($request->ids), 'id');
     if (count($idarr)) {
     	Option::destroy($idarr);
     }
     return redirect()->back();
    }
}
