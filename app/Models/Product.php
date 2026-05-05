<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'id_type',
        'description',
        'unit_price',
        'promotion_price',
        'image',
        'unit',
        'new',
        'stock',
    ];

    protected function casts(): array
    {
        return [
            'unit_price' => 'decimal:2',
            'promotion_price' => 'decimal:2',
            'new' => 'boolean',
        ];
    }

    public function product_type()
    {
        return $this->belongsTo(ProductType::class, 'id_type', 'id');
    }

    public function bill_detail()
    {
        return $this->hasMany(BillDetail::class, 'id_product', 'id');
    }
}
