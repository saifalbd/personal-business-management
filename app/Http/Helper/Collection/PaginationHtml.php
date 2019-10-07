<?php


namespace App\Http\Helper\Collection;


class PaginationHtml
{

    private $resource;

    public function __construct(CustomPagination $resource)
    {
        $this->resource = $resource;
    }


    private function setServerSide(){

        $info = $this->resource;

       // return $info->urlRange::obj()[0];
       // return $info->urlRange::obj()[0]->active;





        return  view('others.customPaginationClass2', compact('info'));
    }


    public function finis(){
        return $this->setServerSide();
    }

}
