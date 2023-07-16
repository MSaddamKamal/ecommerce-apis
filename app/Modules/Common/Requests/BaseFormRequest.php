<?php

namespace App\Modules\Common\Requests;

use App\Modules\Common\Contracts\BaseRequestContract;
use App\Modules\Common\DTO\BaseDTO;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class BaseFormRequest extends FormRequest implements BaseRequestContract
{

    /**
     * @var string[]
     */
    protected $numericKeys = [
        'id'
    ];


    /**
     * @var string[]
     */
    protected $booleanKeys = [
        'pagination'
    ];

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'pagination' => 'boolean'
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
            'pagination'
        ]);
    }

    /**
     * Get the validated request data.
     *
     * @return BaseDTO
     */
    public function toDTO(): BaseDTO
    {
        $input = $this->validatedInput();
        $baseDTO = new BaseDTO();
        foreach ($input as $key => $val) {
            $baseDTO->{$key} = $val;
        }
        return $baseDTO;
    }

    /**
     * Convert to boolean
     *
     * @param $booleable
     * @return boolean
     */
    protected function toBoolean($booleable)
    {
        return filter_var($booleable, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
    }


    /**
     * @param BaseDTO $baseDTO
     * @param array $validateInput
     * @return BaseDTO|null
     */
    protected function castDTO(BaseDTO $baseDTO, array $validateInput): ?BaseDTO
    {
        foreach ($validateInput as $key => $val) {
            if (in_array($key, $this->getNumericKeys())) {
                $val = (int)$val;
            }
            if (in_array($key, $this->getBooleanKeys())) {
                $val = $this->toBoolean($val);
            }
            $baseDTO->{$key} = $val;
        }

        return $baseDTO;
    }

    /**
     * Get boolean keys
     *
     * @return array|null
     */
    protected function getBooleanKeys(): ?array
    {
        return $this->booleanKeys;
    }


    /**
     * @return string[]|null
     */
    protected function getNumericKeys(): ?array
    {
        return $this->numericKeys;
    }

    /**
     * @param Validator $validator
     * @return void
     */
    protected function failedValidation(Validator $validator):void
    {
        $response = [
            'success' => false,
            'data' =>null,
            'message' => $validator->errors()->first(),
        ];

        throw new HttpResponseException(response()->json($response, 422));
    }
}
