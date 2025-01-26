<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'success' => true,
            'products' => ProductResource::collection($this->resource->items()),
            'total_items' => $this->resource->total(),
            'pages_count' => $this->resource->lastPage(),
            'item_per_page' => $this->resource->perPage(),
            'page_num' => $this->resource->currentPage(),
        ];
    }
}
