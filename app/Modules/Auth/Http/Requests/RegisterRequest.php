<?php

namespace App\Modules\Auth\Http\Requests;

use App\Modules\Common\Requests\BaseFormRequest;
use App\Modules\Auth\DTO\UserDTO;
use Illuminate\Support\Facades\Hash;

class RegisterRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules():array
    {
        return [
            'name' => 'required|alpha|max:55',
            'email' => 'email|required|unique:users',
            'password' => 'required|min:6|max:55|confirmed'
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
            'name',
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
        $baseDTO = (new UserDTO([
            'name' => $input['name'],
            'password' => Hash::make($input['password']),
            'email' => $input['email']
        ]));
        return $baseDTO;
    }
}
