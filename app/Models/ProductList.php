<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

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

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function productDetail(): HasOne
    {
        return $this->hasOne(ProductDetails::class, 'product_id', 'id');
    }
}
