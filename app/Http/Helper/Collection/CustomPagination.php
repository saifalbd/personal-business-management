<?php

namespace App\Http\Helper\Collection;
use Illuminate\Support\Str;

//php artisan make:helper class Name 
//command

abstract class CustomPaginationAbstract {

abstract protected function isValid();
abstract protected function urlLoop();
abstract protected function setNextPage();
abstract protected function setPreviousPage();
abstract protected function setFirstPage();
abstract protected function setLastPage();
abstract protected function getUrlRange();
abstract protected function setDetails();
abstract public function callMethod();
abstract protected function setBrekup();
abstract public function withRowList();
abstract public function result();

//abstract private function total();

}

class CustomPagination 
{
	
private $obj;
private $config;
public $rowList = [];
public $pagination = [];
private $isOnly = null;
private $urlRange = [];
private $isPaginat;
private $topText = null;
private $totalRows = 0;
private $totalPages = 0;
private $currentPageRows = 0;
private $isFirstPage = true;
private $isLastPage = false;
private $isNextPage = false;
private $nextPage = null;
private $isPreviousPage = null;
private $previousPage = null;
private $nextPageNumber = 0;
private $previousPageNumber = 0;
private $currentPage = 1;
private $perPage = 1;
private $firstItem = 1;
private $lastItem = 2;
private $firstPage = null;
private $lastPage = null;
private $lastPageNumber = 1;
private $breakupRole = true;
private $breakup = [];
private $data = [];




function __construct($req)
	{
		$this->obj = $req;
	}



/**
 * if use pagination then retrun true
 * @return boolean [description]
 */

private function isValid(){
if (property_exists($this->obj,'perPage') ) {

	$this->isPaginat = true;
	return true;
}else{ return false;}
}






 protected function urlLoop($page,$dotRole = false){

 
$loop =  	['active'=>$this->currentPage==$page ? 1 :null,
			'brek'=>$dotRole?1:null,
			'page'=>$page,
			'url'=>$this->obj->url($page)
		];

   $x =  new AssociativeToObject($loop);
return  $x;

}



protected function setNextPage(){
	$url = $this->isNextPage ? $this->obj->nextPageUrl(): null; 
	return  (object) compact('url');
}
protected function setPreviousPage(){
$url = $this->isPreviousPage ? $this->obj->previousPageUrl(): null; 
	return  (object) compact('url');
}

protected function setFirstPage(){
$url = $this->obj->url(1);
return  (object) compact('url');
	
}

public function setConfig($config)
{
    return $this->config = $config;
}

protected function setTopText(){

    if ($this->config && $this->config['paginationTopText']):

        $con =  $this->config['paginationTopText'];



        $collection = (array) collect(explode(" ",$con))->map(function ($item, $key) {

            if (Str::startsWith($item, '{') && Str::endsWith($item, '}')):

                $replaced = Str::replaceFirst('{', '', $item);
                $replaced = Str::replaceLast('}', '', $replaced);
                $camel =  Str::camel($replaced);

                return property_exists(__CLASS__,$camel)? $this->{$camel}:$camel;

                else:

                return $item;



            endif;
        })->all();

        return implode(' ',$collection);


        else:

        return  'Showing '.$this->firstItem.' to '.$this->lastItem.' of '.$this->totalRows.' records';
            endif;



        }


protected function setLastPage(){
	
	$url = $this->obj->url($this->totalPages);
	return (object) compact('url');
}

/*
protected function setBrekup()
{
	$lastPage = $this->lastPageNumber;
	$from = floor($lastPage/3);
	$to = $lastPage-floor($lastPage/3);
	return compact('from','to');
}

*/

protected function setBrekup()
{
	//floor($lastPage/3);
	$showRows = 9;

if ($showRows>=$this->totalPages) {
$showFromIndex = 0;
$showToIndex = $this->totalPages;
}else{


	$addSubVal = $showRows/2;
	$showFromIndex = $this->currentPage-$addSubVal;
	$showToIndex = $this->currentPage+$addSubVal;

if ($this->currentPage<$addSubVal) {
$showFromIndex = 0;
$showToIndex = $showRows;

}else if ($showToIndex>$this->totalPages) {

$showToIndex = $this->totalPages;
$showFromIndex =$showToIndex-$showRows;

}
}

$diffrant  = $showToIndex-$showFromIndex;
return  (object) compact('showFromIndex','showToIndex','diffrant');
}

/**
 * [paginateRole return number link arrays]
 * @return [type] [description]
 */
private function getUrlRange()
{
$firstPage = 1;
$lastPage = $this->lastPageNumber;
$numberUrl = [];
$breakup = $this->breakup;

if ($this->breakupRole) {

$dotRang =floor($lastPage/3);

for ($page=$firstPage; $page <= $lastPage; $page++) { 
if ($page>=$breakup->showFromIndex && $page<=$breakup->showToIndex) {
$loop = $this->urlLoop($page);
array_push($numberUrl,$loop);
}else{
//$loop = $this->urlLoop($page);
//array_push($numberUrl,$this->urlLoop($page,true));
}

}

}else{
for ($page=$firstPage; $page <= $lastPage; $page++) {

array_push($numberUrl,$this->urlLoop($page));
}


}



return  new MakeCollection($numberUrl);

}


private function setDetails(){
$results = $this->obj;
$this->totalRows = $results->total();
$this->perPage = $results->perPage();
$this->totalPages = ceil($this->totalRows/$this->perPage);
$this->currentPageRows = $results->count();
$this->currentPage = $results->currentPage();
$this->lastItem = $results->lastItem() ??0;
$this->firstItem = $this->lastItem-$this->currentPageRows;
$this->lastPageNumber =$results->lastPage();
$this->isFirstPage = $results->onFirstPage()??false;
$this->isLastPage = $this->totalPages==$this->currentPage;
$this->isNextPage = $this->isLastPage?false:true;
$this->nextPageNumber = $this->isNextPage?$this->currentPage+1 : 0;
$this->isPreviousPage = $this->isFirstPage?false:true;
$this->breakup = $this->setBrekup(); 
$this->previousPageNumber = $this->isPreviousPage?$this->currentPage-1 : 0;
$this->nextPage = $this->setNextPage();
$this->previousPage = $this->setPreviousPage();
$this->firstPage = $this->setFirstPage();
$this->lastPage = $this->setLastPage();
$this->urlRange = $this->getUrlRange();

$this->topText = $this->setTopText();

return $this;
}


private function getPaginationDetails()
{
	$this->setDetails();
$data = [
	'totalRows' =>$this->totalRows,
	'totalPages' =>$this->totalPages,
	'currentPageRows' =>$this->currentPageRows,
	'firstItem' =>$this->firstItem,
	'lastItem' =>$this->lastItem,
	'topText' =>$this->topText,
	'isLastPage' =>$this->isLastPage,
	'isFirstPage' =>$this->isFirstPage,
	'isNextPage' =>$this->isNextPage,
	'isPreviousPage' =>$this->isPreviousPage,
	'currentPage' =>$this->currentPage,
	'previousPageNumber' =>$this->previousPageNumber,
	'nextPageNumber' =>$this->nextPageNumber,
	'breakupRole' =>$this->breakupRole,
	'breakup' =>$this->breakup,
	'nextPage' =>$this->nextPage,
	'previousPage' =>$this->previousPage,
	'firstPage' =>$this->firstPage,
	'lastPage' =>$this->lastPage,
	'urlRange' =>$this->urlRange,
	
];

    $this->data = collect($data)->all();
return $this;
}








private function callMethod($m,$argument = false)
{
if (method_exists($this->obj,$m)) {
return $argument? $this->obj->{$m}($argument): $this->obj->{$m}();
}

return $this->obj;

}











public function result()
{



$valid = $this->isValid();

if ($valid) {

$this->getPaginationDetails();
	}
return $this;

}




    public function toArray(){

    $forArray = $this->data;

    $forArray['urlRange'] = $this->data['urlRange']->toArray();

        return  $forArray;

    }


    use MagicAdd;

 
 } 

