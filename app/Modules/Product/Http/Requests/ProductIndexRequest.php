<?php

namespace App\Modules\Product\Http\Requests;

use App\Modules\Common\Requests\BaseFormRequest;
use App\Modules\Product\DTO\ProductIndexDTO;

class ProductIndexRequest extends BaseFormRequest
{
    /**
     * @var string[]
     */
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
            'pagination' => 'nullable',
            'cart_id' => 'integer',
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
            'pagination',
            'cart_id'
        ]);
    }

    /**
     * Get the validated request data.
     *
     * @return ProductIndexDTO
     */
    public function toDTO(): ProductIndexDTO
    {
        $input = $this->validatedInput();
        $baseDTO = (new ProductIndexDTO())->withAuthUser();
        return $this->castDTO($baseDTO, $input);
    }
}
