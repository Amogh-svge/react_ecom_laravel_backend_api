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


    // RELATIONS
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function productDetail(): HasOne
    {
        return $this->hasOne(ProductDetails::class, 'product_id', 'id');
    }

    // RELATIONS

    // Start of Local Scopes
    public function scopegetByCategory(Builder $query, int $category): Builder
    {
        return $query->where('category_id', $category);
    }

    public function scopeSubCategory(Builder $query, int $subCategory): Builder
    {
        return $query->where('subcategory_id', $subCategory);
    }

    public function scopeProductCode(Builder $query, string $product_code): Builder
    {
        return $query->where('product_code', $product_code);
    }

    public function scopeGetById(Builder $query, int $id): Builder
    {
        return $query->where('id', $id);
    }

    public function scopeSearch(Builder $query, string $SearchQuery): Builder
    {
        return $query->where('title', 'LIKE', "%{$SearchQuery}%")
            ->orWhere('brand', 'LIKE', "%{$SearchQuery}%");
    }

    // End of Local Scopes
}
