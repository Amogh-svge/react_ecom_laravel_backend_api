<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductList extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function scopeCategory(Builder $query, string $category): Builder
    {
        return $query->where('category', $category);
    }

    public function scopeSubCategory(Builder $query, string $subCategory): Builder
    {
        return $query->where('sub_category', $subCategory);
    }

    public function scopeProductCode(Builder $query, string $product_code): Builder
    {
        return $query->where('product_code', $product_code);
    }

    public function scopeGetById(Builder $query, int $id): Builder
    {
        return $query->where('id', $id);
    }
}
