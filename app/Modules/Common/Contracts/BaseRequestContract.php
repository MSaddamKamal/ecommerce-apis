<?php

declare(strict_types=1);

namespace App\Modules\Common\Contracts;

/**
 * @author Syed Muhammad Ali Kamal
 */
interface BaseRequestContract
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array;

    /**
     * Get the validated request data.
     *
     * @return array
     */
    public function validatedInput(): array;
}
