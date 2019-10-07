<?php

namespace App\Http\Controllers;

use App\Exceptions\FlashMessage\Flash;
use App\Http\Helper\Collection\DbCollection;
use App\Http\Resources\Table\RecentActiveResource;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Model\Payment;
use App\Http\Requests\SuccessSearch;
use App\Http\Resources\Table\successResources;
use Illuminate\Http\Response;


class SuccessController extends Controller
{

protected $rowLimit = 10;
private $dateType = 'created_at';

    protected function AssineQuery():Builder
    {
       return Payment::select(['id','amount',$this->dateType])->orderBy($this->dateType,'desc')->order_payment()
           ->Active()
        ->with(['orders:number,type','customers:phone,name','vendors:name']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $infos =$this->AssineQuery()->paginate(10);  //all time plurals like s
       // return $info;
    //  $jsonInfo =  successResources::collection($info);

        $data = collect(collect($infos)['data']);

      //  return DateDrops::distance($data);
//return var_dump($infos);

$sumAmount = $infos->sum('amount');



        $info =  (new DbCollection($infos))
            ->resource(successResources::class)
            ->sum(['amount'])
            ->get();


//return $info;
        return $this->withView('pages.success',compact('info'));
    }

    public function search(SuccessSearch $request)
    {
   $pay =$this->AssineQuery();
    $vendorid =  $request->vendorid;
      $fromDate =  $request->fromDate;
      $toDate =  $request->toDate;
     if ($vendorid) {
  $pay->whereHas('vendors', function ($query) use($vendorid) {
    $query->where('id',$vendorid);
});
     }//

if ($fromDate) {$pay->where('created_at','>=',$fromDate); }
if ($toDate) {$pay->where('created_at','<=',$toDate); }

$info =$pay->paginate($this->rowLimit);


Flash::input('vendorid',$vendorid);
Flash::input('fromDate',$fromDate);
Flash::input('toDate',$toDate);



        $info =  (new DbCollection($info))
            ->resource(successResources::class)
            ->sum(['amount'])
            ->get();
 return $this->withView('pages.success',compact('info'));

    }


    public function recentActive(){
        $this->dateType = 'updated_at';
        $pays = $this->AssineQuery()->whereDate($this->dateType,Carbon::today())->get();

        $info =  (new DbCollection($pays))
            ->resource(RecentActiveResource::class)
            ->sum(['amount'])
            ->get();

       // return $info;
        return $this->withView('pages.recentActive',compact('info'));

        //recentActiveResource
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
