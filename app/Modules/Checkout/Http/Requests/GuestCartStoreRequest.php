<?php

namespace App\Modules\Checkout\Http\Requests;

use App\Modules\Common\Requests\BaseFormRequest;
use App\Modules\Checkout\DTO\GuestCartStoreDTO;

class GuestCartStoreRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'cart_id' => 'nullable',
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
            'product_ids',
            'cart_id'
        ]);
    }

    /**
     * Get the validated request data.
     *
     * @return GuestCartStoreDTO
     */
    public function toDTO(): GuestCartStoreDTO
    {
        $input = $this->validatedInput();
        $baseDTO = (new GuestCartStoreDTO([
            'cart_id' => !empty($input['cart_id']) ? (int)$input['cart_id'] : null,
            'product_ids' => array_map(function($val) {  return (int)$val; }, $input['product_ids'])
        ]));
        return $this->castDTO($baseDTO, $input);
    }
}
