<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Subcategory extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopeCategory(Builder $query, string $category): Builder
    {
        return $query->where('category_name', $category);
    }

    public function category(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_subcategories', 'subcategory_id', 'category_id');
    }
}
