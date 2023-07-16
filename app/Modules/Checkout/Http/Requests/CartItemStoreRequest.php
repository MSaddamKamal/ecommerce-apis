<?php

namespace App\Modules\Checkout\Http\Requests;

use App\Modules\Common\Requests\BaseFormRequest;
use App\Modules\Checkout\DTO\CartItemDTO;

class CartItemStoreRequest extends BaseFormRequest
{
    protected $numericKeys = [
        'cart_id',
        'product_id'
    ];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'cart_id' => 'integer',
            'product_id' => 'required|integer|exists:products,id',
            'quantity' => 'required|integer',
        ];
    }

    /**
     * Get the validated request data.
     *
     * @return array
     */
    public function validatedInput(): array
    {
        return $this->safe()->only([
            'cart_id',
            'product_id',
            'quantity'
        ]);
    }

    /**
     * Get the validated request data.
     *
     * @return CartItemDTO
     */
    public function toDTO(): CartItemDTO
    {
        $input = $this->validatedInput();
        $baseDTO = (new CartItemDTO())->withAuthUser();
        return $this->castDTO($baseDTO, $input);
    }
}
