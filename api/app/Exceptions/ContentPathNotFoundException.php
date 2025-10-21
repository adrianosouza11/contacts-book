<?php

namespace App\Exceptions;

use Exception;

class ContentPathNotFoundException extends Exception
{
    protected $message = 'Content in path not found.';
}
