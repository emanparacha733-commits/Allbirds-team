<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
       'first_name',
    'last_name',
    'customer_name',
    'customer_email',
    'total',
    'status',
    'address',
    'city',
    'state',
    'zip',
    'phone',
    
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}