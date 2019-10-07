<?php

namespace App\Http\Controllers;

use App\Model\Tariff;
use Illuminate\Http\Request;
use App\Http\Requests\{RateCreate,CurrentBankRateCreate};
use App\Model\Rate;
use App\Model\Option;

use Illuminate\Http\Response;
use LogicException;

class RateController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {}

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(int $tariffId)
    {
        $info = Tariff::findOrFail($tariffId);

        return $this->withView('pages.rateCreate',compact('info'));
    }

    public function addBankRate()
    {

       return Option::getCurrentRate()->withView('pages.optionCurrentBankRate',['info'=>[1,2]])->run();
      
        
       
    }

    public function setBankRate(CurrentBankRateCreate $request)
    {

$prevent = $this->preventEntry(Option::class,['option_value'=>$request->bankRate],'1 minute');
if ($prevent) {
   return $prevent;
}else{
return Option::setCurrentRate($request->bankRate)->withSuccses()->withRoute('home')->run();
}
       
       //return redirect()->route('home');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(RateCreate $request,int $tariffId)
    {
        $info = Tariff::findOrFail($tariffId);
    $withCharge =$request->toRate+($request->toRate*0.02);
    Rate::create([
        'from'=>$request->fromRate,
        'to'=>$request->toRate,
        'withCharge'=>$withCharge,
        'tariff_id'=> $info->id]);
    return redirect()->route('tariff.show',['id'=>$info->id])
    ->with('success', 'successfully! Create Rate');
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
        $info = Rate::findOrFail($id);



        return $this->withView('pages.tariff.rateEdit',compact('info'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request,int $tariffId,int $id)
    {
        $to = $request->toRate??false;
        $from = $request->fromRate??false;

        if (!$to){
            throw new LogicException('toRate Requaire');
        }elseif (!$from){
            throw new LogicException('fromRate Requaire');
        }

        $withCharge =$request->toRate+($request->toRate*0.02);
        $tariff = Tariff::findOrFail($tariffId);
        Rate::where(['from'=>$request->fromRate,'tariff_id'=>$tariff->id,'id'=>$id])
            ->update(
                [
                    'to'=>$request->toRate,
                    'withCharge'=>$withCharge
                ]);

        return redirect()->route('tariff.show',['id'=>$tariffId])
            ->with('success', 'successfully! Update Rate');
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
