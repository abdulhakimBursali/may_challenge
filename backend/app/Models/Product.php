<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string, int, string, string>
     */
    protected $fillable = [
        'name',
        'category_id',
        'description',
        'image_url',
    ];

    public function basketProduct()
    {
        return $this->hasMany(BasketProduct::class);
    }
}
