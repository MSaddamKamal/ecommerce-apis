<?php

declare(strict_types=1);

namespace App\Modules\Common\Contracts;
use App\Modules\Common\DTO\BaseDTO;
use Illuminate\Support\Collection;

/**
 * @author Muhammad Saddam
 */
interface BaseRepositoryContract
{
    /**
     * @param int $id
     * @return mixed
     */
    public function baseFind(int $id);


    /**
     * @return mixed
     */
    public function baseAll();

    /**
     * @param BaseDTO $dto
     * @param boolean $noDates
     * @return Collection|null
     */
    public function baseCreate(BaseDTO $dto, $noDates = false): ?Collection;

    /**
     * @param BaseDTO $dto
     * @param int $id
     * @return Collection|null
     */
    public function baseUpdate(BaseDTO $dto, int $id): ?Collection;


    /**
     * @param int $id
     * @return mixed
     */
    public function baseDelete(int $id);
}
