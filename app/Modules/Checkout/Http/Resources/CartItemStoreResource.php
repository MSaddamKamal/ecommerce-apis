<?php

namespace App\Modules\Checkout\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartItemStoreResource extends JsonResource
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
            'data' => $this->resource ? [
                'id' => $this->id,
                'cart_id' => $this->cart_id,
                'product_id' => $this->product_id,
                'quantity' => $this->quantity,
            ] : null,
            'message' => 'Success'
        ];
    }
}
