<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    protected $table = 'bills';

    protected $fillable = [
        'id_customer',
        'user_id',
        'date_order',
        'subtotal',
        'shipping_fee',
        'coupon_code',
        'discount_amount',
        'total',
        'payment',
        'note',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'date_order' => 'date',
            'subtotal' => 'decimal:2',
            'shipping_fee' => 'decimal:2',
            'discount_amount' => 'decimal:2',
            'total' => 'decimal:2',
        ];
    }

    public function bill_detail()
    {
        return $this->hasMany(BillDetail::class, 'id_bill', 'id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_customer', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
