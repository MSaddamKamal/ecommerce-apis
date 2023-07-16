<?php

declare(strict_types=1);

namespace App\Modules\Auth\DTO;

use App\Modules\Common\DTO\BaseDTO;

class UserDTO extends BaseDTO
{
    /**
     * @var int|null
     */
    public ?int $id;

    /**
     * @var string|null
     */
    public ?string $name;

    /**
     * @var string|null
     */
    public ?string $email;

    /**
     * @var string|null
     */
    public ?string $password;

    /**
     * @var string|null
     */
    public ?string $created_at;

    /**
     * @var string|null
     */
    public ?string $updated_at;

}
