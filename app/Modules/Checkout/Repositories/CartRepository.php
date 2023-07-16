<?php

namespace App\Modules\Checkout\Repositories;

use App\Modules\Common\Repositories\BaseRepository;
use App\Modules\Checkout\Contracts\CartRepositoryContract;
use App\Modules\Checkout\DTO\CartDTO;
use App\Modules\Checkout\DTO\CartStoreDTO;
use App\Modules\Checkout\DTO\CartIndexDTO;
use App\Modules\Checkout\DTO\CartDestroyDTO;
use Illuminate\Support\Collection;
use App\Modules\Checkout\Models\Cart;
use App\Modules\Checkout\DTO\CartItemMultipleDTO;
use App\Modules\Checkout\DTO\CartItemDTO;
use App\Modules\Checkout\DTO\GuestCartStoreDTO;

class CartRepository extends BaseRepository implements CartRepositoryContract
{
    /**
     * @var $builder
     */
    protected $builder;

    /**
     * @param Cart $model
     */
    public function __construct(Cart $model)
    {
        parent::__construct($model);
        $this->builder = $model;
    }

    /**
     * @param CartIndexDTO $CartIndexDTO
     * @return Collection|null
     */
    public function all(CartIndexDTO $CartIndexDTO): ?Collection
    {
        return $this->baseAll();
    }

    /**
     * @param CartStoreDTO|null $dto
     * @return Collection|null
     */
    public function create(CartStoreDTO $dto = null): ?Collection
    {
        $cart = $this->byUserId($dto->user_id)->get()->first();
        $cartId = !empty($cart) ? $cart->id : ($this->baseCreate($dto->only('user_id')))->first()->id;

        foreach($dto->product_ids as $productId) {
            $cartItemDTO[] = (new CartItemDTO([
                'cart_id' => $cartId,
                'product_id' => $productId,
                'quantity' => 1
            ]))->only('cart_id', 'product_id', 'quantity');
        }
        app(CartItemRepository::class)->createMultiple(new CartItemMultipleDTO(['cartItemDTO' => $cartItemDTO]));
        return $this->resetBuilder()->byId($cartId)->withCartItems()->get();
    }

    /**
     * @param GuestCartStoreDTO|null $dto
     * @return Collection|null
     */
    public function guestCreate(GuestCartStoreDTO $dto = null): ?Collection
    {
        if (!empty($dto->cart_id)) {
            $cart = $this->byId($dto->cart_id)->get()->first();
        }
        $cartId = !empty($cart) ? $cart->id : ($this->baseCreate((new CartDTO(['user_id'=> null]))->only('user_id'))->first())->id;

        foreach($dto->product_ids as $productId) {
            $cartItemDTO[] = (new CartItemDTO([
                'cart_id' => $cartId,
                'product_id' => $productId,
                'quantity' => 1
            ]))->only('cart_id', 'product_id', 'quantity');
        }
        app(CartItemRepository::class)->createMultiple(new CartItemMultipleDTO(['cartItemDTO' => $cartItemDTO]));
        return $this->resetBuilder()->byId($cartId)->withCartItems()->get();
    }

    /**
     * @param CartDTO|null $dto
     * @return Collection|null
     */
    public function update(CartDTO $dto = null): ?Collection
    {
        return $this->baseUpdate($dto->only('user_id'), $dto->id);
    }

    /**
     * @param CartDestroyDTO $dto
     * @return Collection|null
     */
    public function delete(CartDestroyDTO $dto): ?Collection
    {
        return $this->baseDelete($dto->id);
    }

    /**
     * @param int $user_id
     * @return int|null
     *
     */
    public function getCartIdByUserId($user_id): ?int
    {
        return $this->byUserId($user_id)->get()->pluck('id')->first();
    }

    /**
     * @param int $id
     * @return CartRepository|null
     */
    protected function byId($id): ?self
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
    protected function withCartItems(): self
    {
        $this->builder = $this->builder->with(['cartItems' => function ($query) {
            $query->select('id', 'cart_id', 'product_id', 'quantity');
        }]);
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
