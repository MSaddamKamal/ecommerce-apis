<?php

namespace App\Modules\Analytics\Http\Requests;

use App\Modules\Common\Requests\BaseFormRequest;
use App\Modules\Analytics\DTO\AnalyticsStoreDTO;
use App\Modules\Analytics\Models\Analytic;
use Illuminate\Validation\Rule;

class AnalyticsStoreRequest extends BaseFormRequest
{

    /**
     * @var string[]
     */
    protected $numericKeys = [
        'model_id'
    ];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'event_type' => [
                'required',
                'string',
                Rule::in(array_keys(Analytic::EVENT_TYPE))
            ],
            'model_id' => 'required'
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
            'event_type',
            'model_id'
        ]);
    }

    /**
     * Get the validated request data.
     *
     * @return AnalyticsStoreDTO
     */
    public function toDTO(): AnalyticsStoreDTO
    {
        $input = $this->validatedInput();
        $baseDTO = (new AnalyticsStoreDTO())->withAuthUser();
        return $this->castDTO($baseDTO, $input);
    }
}
