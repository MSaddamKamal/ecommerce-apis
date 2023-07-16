<?php

namespace App\Modules\Common\Repositories;

use App\Modules\Common\Contracts\BaseRepositoryContract;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use App\Modules\Common\DTO\BaseDTO;
use Carbon\Carbon;

abstract class BaseRepository implements BaseRepositoryContract
{

    /**
     * @var Model
     */
    protected $model;

    /**
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @param BaseDTO|null $baseDTO
     * @return Collection|null
     */
    public function baseAll(BaseDTO $baseDTO = null): ?Collection
    {
        if($baseDTO && $baseDTO->pagination == true) {
            return new Collection($this->builder->paginate($baseDTO->per_page ?? 10));
        }
        return $this->builder->get();
    }

    /**
     * @param BaseDTO $dto
     * @param boolean $noDates
     * @return Collection|null
     */
    public function baseCreate(BaseDTO $dto, $noDates = false): ?Collection
    {
        $input = $dto->toArray();
        $newInstance = $this->model->newInstance();
        foreach ($input as $column => $value) {
            $newInstance->{$column} = $value;
        }

        if (!$noDates) {
            $newInstance->created_at = Carbon::now();
            $newInstance->updated_at = Carbon::now();
        }

        if ($newInstance->save()) {
            return new Collection([$newInstance]);
        }

        return null;
    }

    /**
     * @param BaseDTO $dto
     * @param int $id
     * @return Collection|null
     */
    public function baseUpdate(BaseDTO $dto, int $id): ?Collection
    {
        $input = $dto->toArray();
        $model = $this->model->find($id);
        if ($model !== null) {
            foreach ($input as $column => $value) {
                $model->{$column} = $value;
            }
            $model->updated_at = Carbon::now();

            if ($model->save()) {
                return new Collection([$model]);
            }
        }

        return null;
    }

    /**
     * @param int $id
     * @return Collection|null
     */
    public function baseDelete(int $id): ?Collection
    {
        $data = $this->baseFind($id);
        $this->model->find($id)->delete();
        return $data;
    }


    /**
     * @param int $id
     * @return Collection|null
     */
    public function baseFind(int $id): ?Collection
    {
        return Collection::make([$this->model->where('id', $id)->first()]);
    }

    /**
     * @return Collection
     */
    public function get(): ?Collection
    {
        return $this->builder->get();
    }

    /**
     * @param $perPage
     * @return LengthAwarePaginator|null
     */
    public function paginate($perPage): ?LengthAwarePaginator
    {
        return $this->builder->paginate($perPage);
    }
}
