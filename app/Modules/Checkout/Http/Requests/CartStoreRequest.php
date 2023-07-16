<?php

namespace App\Modules\Checkout\Http\Requests;

use App\Modules\Common\Requests\BaseFormRequest;
use App\Modules\Checkout\DTO\CartStoreDTO;

class CartStoreRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'product_ids' => 'required|array',
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
            'product_ids'
        ]);
    }

    /**
     * Get the validated request data.
     *
     * @return CartStoreDTO
     */
    public function toDTO(): CartStoreDTO
    {
        $input = $this->validatedInput();
        $baseDTO = (new CartStoreDTO([
            'product_ids' => array_map(function($val) {  return (int)$val; }, $input['product_ids'])
        ]))->withAuthUser();
        return $this->castDTO($baseDTO, $input);
    }
}
