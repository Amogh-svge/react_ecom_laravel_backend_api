<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function products()
    {
        $this->hasMany(ProductList::class, 'product_id', 'id');
    }

    public function subCategory(): BelongsToMany
    {
        return $this->belongsToMany(Subcategory::class, 'category_subcategories', 'category_id', 'subcategory_id');
    }
}
