<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'type',
        'first_name',
        'last_name',
        'country',
        'street_address',
        'state',
        'city',
        'postal_code',
        'phone_number',
        'email',
    ];

    public $timestamps = false;
}
