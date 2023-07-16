<?php

namespace App\Modules\Checkout\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Checkout\Contracts\CartItemRepositoryContract;
use App\Modules\Checkout\Http\Requests\CartItemStoreRequest;
use App\Modules\Checkout\Http\Requests\CartItemIndexRequest;
use App\Modules\Checkout\Http\Requests\CartItemDestroyRequest;
use App\Modules\Checkout\Http\Requests\CartItemAddGuestItemsToUserCartRequest;
use App\Modules\Checkout\Http\Resources\CartItemCollection;
use App\Modules\Checkout\Http\Resources\CartItemStoreResource;
use App\Modules\Checkout\Http\Resources\CartItemDestroyResource;
use App\Modules\Checkout\Contracts\CartRepositoryContract;

class CartItemController extends Controller
{
    /**
     * @var CartItemRepositoryContract
     */
    protected CartItemRepositoryContract $cartItemRepo;
    protected CartRepositoryContract $cartRepo;

    /**
     * @param CartItemRepositoryContract $cartItemRepo
     */
    public function __construct(CartItemRepositoryContract $cartItemRepo, CartRepositoryContract $cartRepo)
    {
        $this->cartItemRepo = $cartItemRepo;
        $this->cartRepo = $cartRepo;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(CartItemIndexRequest $request): CartItemCollection
    {
        $dto = $request->toDTO();
        if($dto->user_id) {
            $dto->cart_id = $this->cartRepo->getCartIdByUserId($dto->user_id);
        }

        $data = $this->cartItemRepo->all($dto);
        return new CartItemCollection($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CartItemStoreRequest $request): CartItemStoreResource
    {
        $dto = $request->toDTO();
        $data = $this->cartItemRepo->create($dto);
        return new CartItemStoreResource($data? $data->first(): null);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CartItemDestroyRequest $request, int $id)
    {
        $input = $request->toDTO();
        $data = $this->cartItemRepo->delete($input);
        return new CartItemDestroyResource($data ? $data->first() : null);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function addGuestItemsToUserCart(CartItemAddGuestItemsToUserCartRequest $request)
    {
        $this->cartItemRepo->mergeCartItems($request->toDTO());
        return response()->json(['message' => 'Cart items merged successfully']);
    }
}
