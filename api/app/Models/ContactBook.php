<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactBook extends Model
{
    use HasFactory;

    protected $fillable = [
        'contact_name',
        'contact_phone',
        'contact_email',
        'address',
        'number',
        'neighborhood',
        'city',
        'state',
        'postal_code'
    ];
}
