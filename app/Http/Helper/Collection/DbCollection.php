<?php


namespace App\Http\Helper\Collection;
use App\Exceptions\FetalException as Err;




class DbCollection extends ResourceDataCollection
{



    private $modelData;
    private $isPaginate;
    protected $data=[];
    private $sumKeys;

    protected $changeKey = [
        'list'=>'list',
        'pagination'=>'pagination',
        'paginationHtml'=>'paginationHtml',
        'sum'=>'sum'
    ];

    public function __construct($resource)
    {
        $this->modelData = $resource;
        $this->isPaginate = $this->canPaginate($resource);


    }

    private function canPaginate($collection){

        return is_a($collection,'Illuminate\Pagination\LengthAwarePaginator');

    }


    private function  getPagination(){

        if ($this->isPaginate){
            $page =  new CustomPagination($this->modelData);

            return $page->result();


        }

        return null;



    }


    protected function makeCollection($data){

        $col = $data->map(function ($item,$key){
            return new AssociativeToObject($item->toArray(''));
        });


        return new MakeCollection($col->toArray(''));
        //return new Collection();
    }
    private function setResultData(){

        $list = $this->makeCollection($this->collection);

        $this->data[$this->changeKey['list']]= $list;

        if ($this->sumKeys){
           // dd($this->collection[0]->id);
            $list = collect($this->collection)->toArray();

            $this->data[$this->changeKey['sum']] = (new Sum($list,$this->sumKeys))->finish();
        }


        if ($this->isPaginate){
            $this->data[$this->changeKey['pagination']]  = $this->getPagination();
           ///dd(var_dump($this->data[$this->changeKey['pagination']]));
            $this->data[$this->changeKey['paginationHtml']] = (new  PaginationHtml($this->data[$this->changeKey['pagination']]))->finis();

        }



        return $this;




    }

    private function getResulData(){
        $this->setResultData();


        $forArr = collect($this->data)->map(function ($item,$key){

            return  $key==$this->changeKey['list']||$key==$this->changeKey['sum']||$key==$this->changeKey['pagination']   ? $item->toArray():$item;

        });



        return $forArr;


    }



    public function sum(array $arr){

        if (is_array($arr)){

            $arrIs = collect($arr);

            if ($arrIs->count()){

                $arrIsString = $arrIs->every(function ($item,$key){return is_string($item);});

                if ($arrIsString){

                    $this->sumKeys =$arr;

                    return $this;


                    }else{

                        throw new  Err('array all values not are string');
                        }

             }else{
                throw new  Err('sum array are empty');
            }


        }else{

            throw new  Err('allow only array on sum argument');
        }

    }



    function toArray($request = null)
    {

        //return $this->sumKeys;

        return ['data'=>$this->getResulData()];
    }
//public $collects = successResources::class;

    /**
     * @param $res Resources::class
     * @return $this
     */
    public function resource($res){

        $this->collects =$res;
        return $this;
    }



    public function get(){

        //remove default links and meta

        if ($this->isPaginate){
            $resource = $this->modelData->getCollection();
        }else{
            $resource = $this->modelData;
        }

        parent::__construct($resource);

        $this->setResultData();

        return $this;

    }




    use MagicAdd;


}