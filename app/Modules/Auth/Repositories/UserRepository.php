<?php

namespace App\Modules\Auth\Repositories;

use App\Modules\Common\Repositories\BaseRepository;
use App\Modules\Auth\Contracts\UserRepositoryContract;
use App\Modules\Auth\DTO\UserDTO;
use Illuminate\Support\Collection;
use App\Modules\Auth\Models\User;

class UserRepository extends BaseRepository implements UserRepositoryContract
{
    /**
     * @var $builder
     */
    protected $builder;

    /**
     * @var User
     */
    protected $model;

    /**
     * @param User $model
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * @param UserDTO|null $dto
     * @return Collection|null
     */
    public function create(UserDTO $dto = null): ?Collection
    {
        $data = $dto->only('name','email','password');
        return $this->baseCreate($data);
    }
}
