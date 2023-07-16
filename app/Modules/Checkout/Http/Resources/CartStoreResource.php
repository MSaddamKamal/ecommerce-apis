<?php

namespace App\Modules\Checkout\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartStoreResource extends JsonResource
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
                'user_id' => $this->user_id,
                'cart_items' => $this->cartItems
            ] : null,
            'message' => 'Success'
        ];
    }
}
