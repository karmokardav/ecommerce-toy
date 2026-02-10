<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'address',
        'total',
        'payment_method',
        'payment_status'
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

}
