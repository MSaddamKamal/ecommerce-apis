<?php

namespace App\Modules\Analytics\Repositories;

use App\Modules\Common\Repositories\BaseRepository;
use App\Modules\Analytics\Contracts\AnalyticsRepositoryContract;
use App\Modules\Analytics\Models\Analytic;
use App\Modules\Analytics\DTO\AnalyticsStoreDTO;
use Illuminate\Support\Collection;

class AnalyticsRepository extends BaseRepository implements AnalyticsRepositoryContract
{
    /**
     * @var $builder
     */
    protected $builder;

    /**
     * @param Analytic $model
     */
    public function __construct(Analytic $model)
    {
        parent::__construct($model);
        $this->builder = $model;
    }

    /**
     * @param AnalyticsStoreDTO|null $dto
     * @return Collection|null
     */
    public function create(AnalyticsStoreDTO $dto = null): ?Collection
    {
        return $this->baseCreate($dto->only('event_type','model', 'model_id', 'user_id'));
    }

    /**
     * @param int $id
     * @return self
     */
    public function byId($id): ?self
    {
        $this->builder = $this->builder->where('id', $id);
        return $this;
    }

    /**
     * @param int $userId
     * @return self
     */
    protected function byUserId(int $userId): self
    {
        $this->builder = $this->builder->where('user_id', $userId);
        return $this;
    }

    /**
     * @return self
     */
    protected function resetBuilder(): self
    {
        $this->builder = $this->model;
        return $this;
    }
}
