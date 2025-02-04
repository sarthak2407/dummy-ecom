<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'quantity' => $this->pivot ? $this->pivot->quantity : null,
            'total_item_price' => $this->pivot 
                ? ($this->price * $this->pivot->quantity) 
                : null,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}