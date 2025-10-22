<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string contact_name
 * @property string contact_phone
 * @property string contact_email
 * @property string address
 * @property string number
 * @property string neighborhood
 * @property string city
 * @property string state
 * @property string postal_code
 */
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
