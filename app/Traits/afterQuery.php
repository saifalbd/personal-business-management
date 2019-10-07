<?php

namespace App\Traits;

//php artisan make:trait MyTrait 
//command
use App\Http\Controllers\Controller;
use Session;

trait afterQuery
{
	protected $success = false;
	protected $route =null;
	protected $viewIs = null;
	
   public function withSuccses($txt = false)
   {
   
   	$this->success = $txt?:'successFully Data Insert';
   	return $this; 
   	
   }
   public function withRoute($url,$params =false)
   {

$this->route =(object)  [];
if (strpos($url, '@',1)) {

$this->route->action = $url;
}else{
  $this->route->name = $url; 
}
if ($params) {
$this->route->params = $params;
}
return $this;

   }

public function withView($blade,$infos=[])
{
	
	$data = is_array($infos) && is_object($infos) ? $infos : $this;

$this->viewIs = (object) ['blade'=>$blade,'infos'=>$data];
//'view'=>function() use ($cl,$data){return $cl->withView($blade,['info'=>$data]);}];
	
return $this;
}
public function run()
{
if ($this->success) {
Session::flash('success', $this->success );
}
if ($this->route) {

$route = $this->route;
$url  = null;
if ($route->name) {
if (isset($route->params)) {
return redirect()->route($route->name,$route->params);
}else{
return redirect()->route($route->name);
}

}else {
if (isset($route->params)) {
return redirect()->action($route->action,$route->params);
}else{
return redirect()->route($route->action);
}
}


	}else if($this->viewIs){
	$calledClass = get_called_class();
	
	$cl = new  Controller();
if (is_array($this->viewIs->infos)) {
	$info = ['rowList'=>$this->viewIs->infos];
}else {
$info = ['info'=>$this->viewIs->infos];
}
return $cl->withView($this->viewIs->blade,$info);
	}else{
		return $this;
	}	
}

}