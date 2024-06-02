<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BasketUser extends Model
{
    use HasFactory;

    protected $table = 'basket_user';

    protected $guarded = [
        'basket_id',
        'user_id',
    ];

    /**
     * BasketProduct
     */
    public function basketProducts(): HasMany
    {
        return $this->hasMany(BasketProduct::class, 'basket_id');
    }
}
