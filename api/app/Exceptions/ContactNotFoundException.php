<?php

namespace App\Exceptions;

use Exception;

class ContactNotFoundException extends Exception
{
    protected $message = 'Contact not found.';
}
