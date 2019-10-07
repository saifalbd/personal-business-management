<?php


namespace App\Http\Helper\Collection;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ResourceDataCollection extends ResourceCollection
{


    protected $dataCollection;


    public function __construct($resource)
    {
       // $res = $resource->getCollection();

        parent::__construct($resource);

        $this->dataCollection  = $this->collection;
    }


    public function  toArray($request)
    {
        return parent::toArray($request); // TODO: Change the autogenerated stub
    }


}