<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * The "data" wrapper that should be applied.
     *
     * @var string|null
     */
    public static $wrap = 'product';

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "title" => $this->title,
            "price" => $this->price,
            "special_price" => $this->special_price,
            "image" => $this->image,
            "category" => $this->category,
            "sub_category" => $this->sub_category,
            "remark" => $this->remark,
            "brand" => $this->brand,
            "rating" => $this->rating,
            "product_code" => $this->product_code,
        ];
    }
}
