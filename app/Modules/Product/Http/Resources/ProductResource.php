<?php

namespace App\Modules\Product\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'success' =>true,
            'data' =>[
                'id' => $this->id,
                'name' => $this->name,
                'sku' => $this->sku,
                'image_url' => $this->image_url,
                'price' => $this->price,
                'quantity' => $this->quantity,
            ],
            'message' => 'Success'
        ];
    }
}
