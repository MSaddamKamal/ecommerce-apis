<?php

namespace App\Modules\Checkout\Http\Requests;

use App\Modules\Common\Requests\BaseFormRequest;
use App\Modules\Checkout\DTO\CartItemIndexDTO;

class CartItemIndexRequest extends BaseFormRequest
{
    protected $numericKeys = [
        'page',
        'page_size',
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
            'page' => 'nullable',
            'page_size' => 'nullable',
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
            'page',
            'page_size',
            'cart_id'
        ]);
    }

    /**
     * Get the validated request data.
     *
     * @return CartItemIndexDTO
     */
    public function toDTO(): CartItemIndexDTO
    {
        $input = $this->validatedInput();
        $baseDTO = (new CartItemIndexDTO())->withAuthUser();
        return $this->castDTO($baseDTO, $input);
    }
}
