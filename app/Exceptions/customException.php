<?php

namespace App\Exceptions;

use Exception;

class customException extends Exception
{
    function report()
    {

    }
    function render()
    {
        return response()->view('errors.register');
    }
}
