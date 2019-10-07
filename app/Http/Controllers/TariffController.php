<?php

namespace App\Http\Controllers;

use App\Model\Rate;
use App\Repositories\TariffRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Requests\TariffCreate;
use App\Model\Tariff;
use Illuminate\Http\Response;

class TariffController extends Controller
{

    protected  $tariff;

    public function __construct(TariffRepositoryInterface $tariff)
    {

        $this->tariff = $tariff;
    }


    public function RateAdd(array $arg){

        return Rate::Create($arg);

    }

    public function rateFromToImport(int $fromId,int $toId){


        $from = Tariff::with('rates')->findOrFail($fromId);


        if (count($from->rates)):

          $rates =   collect($from->rates)->map(function ($item,$key) use ($toId){
              return collect($item)
                  ->forget(['tariff_id','deleted_at','created_at','updated_at'])
                  ->put('tariff_id', $toId);

          })->each(function ($item, $key) {
             return $this->RateAdd($item->toArray());
          });


        return $rates;

            else:
                return [];
            endif;



    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $rowList = Tariff::all();
        return $this->withView('pages.tariff.tariff',compact('rowList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $tariffList = Tariff::select('id','name')->get();
        return $this->withView('pages.tariff.create',compact('tariffList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(TariffCreate $request)
    {

        $tariff = Tariff::Create(['name'=>$request->tarifName]);
        if ($request->importId){
           $this->rateFromToImport($request->importId,$tariff->id);
        }

        return redirect()->route('tariff');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $info = Tariff::with('rates')->findOrFail($id);

        //return $info->ratesRes->list;

        return $this->withView('pages.tariff.showTariff',compact('info'));

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
    public function destroy(int $id)
    {
        $this->tariff->remove($id);

        return redirect()->back();
    }
}
