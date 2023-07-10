<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartOrder extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopeOrderStatus(Builder $query, string $orderStatus): Builder
    {
        return $query->where('order_status', $orderStatus);
    }
}
