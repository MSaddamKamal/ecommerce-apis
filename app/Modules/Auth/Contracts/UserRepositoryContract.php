<?php

declare(strict_types=1);

namespace App\Modules\Auth\Contracts;


use App\Modules\Auth\DTO\UserDTO;
use Illuminate\Support\Collection;

/**
 * @author Muhammad Saddam
 */
interface UserRepositoryContract
{
    /**
     * @param UserDTO|null $dto
     * @return Collection|null
     */
    public function create(UserDTO $dto = null): ?Collection;
}
