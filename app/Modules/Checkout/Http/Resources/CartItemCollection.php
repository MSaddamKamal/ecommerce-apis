<?php

namespace App\Modules\Checkout\Http\Resources;

use App\Modules\Product\Http\Resources\ProductResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CartItemCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'success' => true,
            'data' => $this->collection->map(function ($item) {
                return [
                    'id' => $item->id,
                    'cart_id' => $item->cart_id,
                    'product' => $item->product,
                    'quantity' => $item->quantity,
                ];
            }),
            'pagination' => false,
            'message' => 'Success'
        ];
    }
}
