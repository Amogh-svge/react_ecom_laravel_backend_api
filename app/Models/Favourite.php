<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favourite extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopeProductCode(Builder $query, string $product_code): Builder
    {
        return $query->where('product_code', $product_code);
    }
}
