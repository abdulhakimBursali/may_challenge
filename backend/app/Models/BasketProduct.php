<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BasketProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'basket_id',
        'product_id',
    ];

    public $timestamps = false;

    /**
     * Products in basket.
     */
    public function products(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function basketUser()
    {
        return $this->belongsTo(BasketUser::class, 'basket_id');
    }
}
