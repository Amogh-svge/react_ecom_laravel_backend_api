<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Favourite extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function products(): HasMany
    {
        return $this->hasMany(ProductList::class, 'id', 'product_id');
    }

    public function scopeProductCode(Builder $query, string $product_code): Builder
    {
        return $query->where('product_code', $product_code);
    }

    public function scopeEmail(Builder $query, string $email): Builder
    {
        return $query->where('email', $email);
    }
}
