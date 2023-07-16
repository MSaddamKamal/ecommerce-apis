<?php

declare(strict_types=1);

namespace App\Modules\Product\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Checkout\Contracts\CartRepositoryContract;
use App\Modules\Product\Http\Requests\ProductIndexRequest;
use App\Modules\Product\Http\Requests\ProductGuestIndexRequest;
use App\Modules\Product\Http\Resources\ProductCollection;
use App\Modules\Product\Http\Resources\ProductResource;
use Illuminate\Http\Request;
use App\Modules\Product\Contracts\ProductRepositoryContract;

class ProductController extends Controller
{

    /**
     * @var ProductRepositoryContract
     */
    protected ProductRepositoryContract $product_repo;

    protected CartRepositoryContract $cart_repo;

    /**
     * @param ProductRepositoryContract $product_repo
     */
    public function __construct(ProductRepositoryContract $product_repo,CartRepositoryContract $cart_repo)
    {
        $this->product_repo = $product_repo;
        $this->cart_repo = $cart_repo;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(ProductIndexRequest $request)
    {
        $dto = $request->toDTO();
        if($dto->user_id){
            $cart_id = $this->cart_repo->getCartIdByUserId($dto->user_id);
        }
        $dto->cart_id = $cart_id ?? $dto->cart_id;
        $data = $this->product_repo->all($dto);
        return new ProductCollection($data);
    }

    /**
     * Display a listing of the resource.
     */
    public function guestIndex(ProductGuestIndexRequest $request)
    {
        $dto = $request->toDTO();
        $data = $this->product_repo->all($dto);
        return new ProductCollection($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return new ProductResource($this->product_repo->find($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
