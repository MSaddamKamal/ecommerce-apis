<?php

namespace App\Modules\Checkout\Http\Requests;

use App\Modules\Common\Requests\BaseFormRequest;
use App\Modules\Checkout\DTO\CartItemDestroyDTO;

class CartItemDestroyRequest extends BaseFormRequest
{
    protected $numericKeys = [
        'id'
    ];

    public function validationData()
    {
        $this->request->add(['id' => $this->route('id')]);
        return $this->request->all();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'id'=>'required|integer|exists:cart_items,id'
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
            'id',
        ]);
    }

    /**
     * Get the validated request data.
     *
     * @return CartItemDestroyDTO
     */
    public function toDTO(): CartItemDestroyDTO
    {
        $input = $this->validatedInput();
        $baseDTO = new CartItemDestroyDTO();
        return $this->castDTO($baseDTO, $input);
    }
}
