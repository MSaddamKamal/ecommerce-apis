<?php

namespace App\Modules\Analytics\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Analytics\Contracts\AnalyticsRepositoryContract;
use App\Modules\Analytics\Http\Requests\AnalyticsStoreRequest;
use App\Modules\Analytics\Http\Resources\AnalyticsStoreResource;
use App\Modules\Analytics\Models\Analytic;

class AnalyticsController extends Controller
{
    /**
     * @var AnalyticsRepositoryContract
     */
    protected AnalyticsRepositoryContract $analyticsRepo;

    /**
     * @param AnalyticsRepositoryContract $analyticsRepo
     */
    public function __construct(AnalyticsRepositoryContract $analyticsRepo)
    {
        $this->analyticsRepo = $analyticsRepo;
    }

    /**
     * Store a newly created resource in storage.
     * @param AnalyticsStoreRequest $request
     * @return AnalyticsStoreResource
     */
    public function store(AnalyticsStoreRequest $request): AnalyticsStoreResource
    {
        $dto = $request->toDTO();
        $dto->model = Analytic::EVENT_TYPE[$dto->event_type];
        app(Analytic::ACTIONS_EVENT[$dto->event_type])->dispatch($dto);
        return new AnalyticsStoreResource(['message' => $dto->event_type." has been created"]);
    }
}
