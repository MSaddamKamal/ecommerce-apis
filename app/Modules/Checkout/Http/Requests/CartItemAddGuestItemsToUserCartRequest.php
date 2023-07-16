<?php

namespace App\Modules\Checkout\Http\Requests;

use App\Modules\Common\Requests\BaseFormRequest;
use App\Modules\Checkout\DTO\CartItemAddGuestItemsToUserCartDTO;

class CartItemAddGuestItemsToUserCartRequest extends BaseFormRequest
{
    protected $numericKeys = [
        'cart_id'
    ];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'cart_id' => 'nullable'
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
            'cart_id'
        ]);
    }

    /**
     * Get the validated request data.
     *
     * @return CartItemAddGuestItemsToUserCartDTO
     */
    public function toDTO(): CartItemAddGuestItemsToUserCartDTO
    {
        $input = $this->validatedInput();
        $baseDTO = (new CartItemAddGuestItemsToUserCartDTO())->withAuthUser();
        return $this->castDTO($baseDTO, $input);
    }
}
