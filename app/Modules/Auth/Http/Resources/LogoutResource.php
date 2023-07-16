<?php

namespace App\Modules\Auth\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LogoutResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'success' =>true,
            'data' =>[
                'id' => $this->id,
                'name' => $this->name,
                'email' => $this->email,
            ],
            'message' => 'Success'
        ];
    }
}
