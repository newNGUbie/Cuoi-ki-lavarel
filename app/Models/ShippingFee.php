<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingFee extends Model
{
    protected $table = 'shipping_fees';

    protected $fillable = [
        'name',
        'city',
        'fee',
        'free_shipping_min_total',
        'is_active',
    ];

    protected $casts = [
        'fee' => 'decimal:2',
        'free_shipping_min_total' => 'decimal:2',
        'is_active' => 'boolean',
    ];
}
