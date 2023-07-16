<?php

namespace App\Modules\Checkout\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Checkout\Contracts\CartRepositoryContract;
use App\Modules\Checkout\Contracts\CartItemRepositoryContract;
use App\Modules\Checkout\Http\Requests\CartStoreRequest;
use App\Modules\Checkout\Http\Requests\GuestCartStoreRequest;
use App\Modules\Checkout\Http\Resources\CartStoreResource;

class CartController extends Controller
{
    /**
     * @var CartRepositoryContract
     */
    protected CartItemRepositoryContract $cartItemRepo;
    protected CartRepositoryContract $cartRepo;

    /**
     * @param CartRepositoryContract $cartItemRepo
     * @param CartItemRepositoryContract $cartItemRepo
     */
    public function __construct(CartRepositoryContract $cartRepo)
    {
        $this->cartRepo = $cartRepo;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CartStoreRequest $request): CartStoreResource
    {
        $dto = $request->toDTO();
        $data = $this->cartRepo->create($dto);
        return new CartStoreResource($data? $data->first(): null);
    }

    /**
     * Store a newly created resource in storage for a Guest user.
     */
    public function guestStore(GuestCartStoreRequest $request): CartStoreResource
    {
        $dto = $request->toDTO();
        $data = $this->cartRepo->guestCreate($dto);
        return new CartStoreResource($data? $data->first(): null);
    }
}
