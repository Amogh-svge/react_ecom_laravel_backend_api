<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCart extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopeProductCode(Builder $query, string $product_code): Builder
    {
        return $query->where('product_code', $product_code);
    }

    public function scopeEmail(Builder $query, string $email): Builder
    {
        return $query->where('email', $email);
    }

    public function scopeGetById(Builder $query, int $id): Builder
    {
        return $query->where('id', $id);
    }
}
