<?php



if (! function_exists('numberTowords')) {
  

function numberTowords($number = 0)
{ 
 $f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
return $f->format($number); 

}

}
if (! function_exists('withSymbol')) {


    function withSymbol($value,$symbol)
    {
        return $value.$symbol;

    }

}


if (! function_exists('makeStd')){

    function makeStd($args){

        $result = [];
        foreach ($args as $key=>$value){

            $result[$key] = $value;
        }

        return (object) $result;

    }

}



    if (! function_exists('dateIs')) {
  

function dateIs($date)
{ 
	return $date;

return date_format(date_create($date),"Y/m/d H:i:s");

};

}

    if (! function_exists('dateToWord')){

        function dateToWord($dateOnly){
            $txtFormat = 'l jS \\of F Y';

          return  date_format(date_create($dateOnly),$txtFormat);
        }
    }

if (! function_exists('input')) {
  

function input($name)
{ 

	$old = old($name);
	if ($old) {
		return $old;
	}else {

		return \App\Exceptions\FlashMessage\Flash::find('input'.'.'.$name);

	}

};

}

if (! function_exists('isEqual')) {
  

function isEqual(Array $arr,$txt = true)
{ 

$arrIs = count($arr) == 2 ? $arr :false;
if ($arrIs) {
if ($arrIs[0]==$arrIs[1]) {
	return $txt;
}else{
	return false;
}
}

};

}

if (! function_exists('isVal')) {
  

function isVal($Value,$compare,$then,$thenElse='')
{ 

if ($Value == $compare) {
	return $then;
}else{
return $thenElse;
}

};

}

if (!function_exists('getErrors')){
    function  getErrors()
    {
        if (isset($errors) && method_exists($errors, 'any') && $errors->any()) {
            return $errors->all();
        }
        return [];
    }

}
if (!function_exists('getSession')){
    function getSession($key){
        $sess =  session()->has($key)??false;
        return $sess??null;

    }
}
if (!function_exists('serverMessage')){
    function serverMessage(){
        $errorsMessage = getErrors();
        $errorMessage = getSession('error');
        $createMessage = getSession('created');
       // $createMessage = 'this is test create';
        $successMessage = getSession('success');
        $updateMessage = getSession('updated');
        $uploadMessage = getSession('uploaded');
        $removeMessage = getSession('removed');
        $addMessage = getSession('added');

        $data = compact(
            'errorsMessage',
            'errorMessage',
            'createMessage',
            'successMessage',
            'updateMessage',
            'uploadMessage',
            'removeMessage',
            'addMessage'
        );

        return collect($data)->toJson();


    }
}