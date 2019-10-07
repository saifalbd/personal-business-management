<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CustomException extends Exception
{
   //use App\Exceptions\InvalidArg;
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

//dd(withError($exception->getMessage())->withInput());
return back()->withError([$this->getMessage()])->withInput();

        return response()->view(
                'errors.custom',
                array(
                    'exception' => $this
                )
        );
        
    }

}
