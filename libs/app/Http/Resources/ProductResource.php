<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $price = $this->special ?? $this->price;
        $oldPrice = $this->special ? $this->price : null;

        return [
            'title' => $this->name,
            'id' => (string) $this->id,
            'price' => (int) $price,
            'old_price' => $oldPrice ? (int) $oldPrice : null,
            'category' => $this->category->name ?? null,
            'is_available' => $this->stock > 0 && !$this->hide_price,
            'url' => route('products.show', $this->slug),
        ];
    }
}
