<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FormException extends Exception
{
     /**
     * Report the exception.
     *
     * @return void
     */
    public function report()
    {
    }
 
    /**
     * Render the exception into an HTTP response.
     *
     * @param  Request
     * @return Response
     */
    public function render($request)
    {


/**
 * error must be return array withError([message])
 */
return back()->withErrors($this->getMessage())->withInput();

}
}
