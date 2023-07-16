<?php

namespace App\Modules\Auth\Http\Requests;

use App\Modules\Common\Requests\BaseFormRequest;
use App\Modules\Auth\DTO\UserDTO;

class LoginRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'email' => 'email|required',
            'password' => 'required|min:6|max:55'
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
            'email',
            'password'
        ]);
    }

    /**
     * Get the validated request data.
     *
     * @return UserDTO
     */
    public function toDTO(): UserDTO
    {
        $input = $this->validatedInput();
        $baseDTO = (new UserDTO())->withAuthUser();
        return $this->castDTO($baseDTO, $input);
    }
}
