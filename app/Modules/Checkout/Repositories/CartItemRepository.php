<?php

namespace App\Modules\Checkout\Repositories;

use App\Modules\Checkout\Contracts\CartRepositoryContract;
use App\Modules\Checkout\DTO\CartDTO;
use App\Modules\Common\Repositories\BaseRepository;
use App\Modules\Checkout\Contracts\CartItemRepositoryContract;
use App\Modules\Checkout\DTO\CartItemDTO;
use Illuminate\Support\Collection;
use App\Modules\Checkout\Models\CartItem;
use App\Modules\Checkout\DTO\CartItemIndexDTO;
use App\Modules\Checkout\DTO\CartItemDestroyDTO;
use App\Modules\Checkout\DTO\CartItemMultipleDTO;
use App\Modules\Checkout\DTO\CartItemAddGuestItemsToUserCartDTO;

class CartItemRepository extends BaseRepository implements CartItemRepositoryContract
{
    /**
     * @var $builder
     */
    protected $builder;

    /**
     * @var $cartRepo
     */
    protected $cartRepo;

    /**
     * @param CartItem $model
     * @param CartRepositoryContract $cartRepo
     */
    public function __construct(CartItem $model, CartRepositoryContract $cartRepo)
    {
        parent::__construct($model);
        $this->builder = $model;
        $this->cartRepo = $cartRepo;
    }

    /**
     * @param CartItemIndexDTO $cartItemIndexDTO
     * @return Collection|null
     */
    public function all(CartItemIndexDTO $cartItemIndexDTO): ?Collection
    {
        if(empty($cartItemIndexDTO->cart_id)) return collect([]);
        $this->byCartId($cartItemIndexDTO->cart_id)->withProducts();
        return $this->baseAll();
    }

    /**
     * @param CartItemDTO|null $dto
     * @return Collection|null
     */
    public function create(CartItemDTO $dto = null): ?Collection
    {
        $cart_item_exists = $this->byCartId($dto->cart_id)->byProductId($dto->product_id)->get()->first();
        if (!empty($cart_item_exists)) {
            $dto->id = $cart_item_exists->id;
            $dto->quantity = $cart_item_exists->quantity + 1;
            return $this->update($dto);
        }

        return $this->baseCreate($dto->only('cart_id', 'product_id', 'quantity'));
    }

    /**
     * @param CartItemMultipleDTO|null $dto
     * @return Collection|null
     */
    public function createMultiple(CartItemMultipleDTO $dto = null): ?Collection
    {
        $result = [];
        foreach ($dto->cartItemDTO as $cartItemDTO) {
            $this->builder = $this->model;
            $create = $this->create($cartItemDTO);
            $result[] = $create->first();
        }
        return empty($result) ? new Collection([]) : new Collection($result);
    }

    /**
     * @param CartItemDTO|null $dto
     * @return Collection|null
     */
    public function update(CartItemDTO $dto = null): ?Collection
    {
        return $this->baseUpdate($dto->only('cart_id', 'product_id', 'quantity'), $dto->id);
    }

    /**
     * @param CartItemDestroyDTO $dto
     * @return Collection|null
     */
    public function delete(CartItemDestroyDTO $dto): ?Collection
    {
        $item = $this->byId($dto->id)->get()->first();
        if ($item->quantity > 1) {
            $item->quantity = $item->quantity - 1;
            return $this->update(new CartItemDTO($item->toArray()));
        } else {
            return $this->baseDelete($dto->id);
        }

    }

    /**
     * @param CartItemAddGuestItemsToUserCartDTO $cartItemAddGuestItemsToUserCartDTO
     */
    public function mergeCartItems(CartItemAddGuestItemsToUserCartDTO $cartItemAddGuestItemsToUserCartDTO)
    {
        $cartId = $cartItemAddGuestItemsToUserCartDTO->cart_id;
        $userId = $cartItemAddGuestItemsToUserCartDTO->user_id;

        $guest_cart_items = $this->model->where('cart_id', $cartId)->with('product')->get();
        $user_cart_id = $this->cartRepo->getCartIdByUserId($userId);
        if(!$user_cart_id){
            // means auth user has not created any cart
            // yet so just update the user_id in cart table for current auth user
            $data = new CartDTO([
                'user_id'=>$userId,
                'id' => $cartId
            ]);
            $this->cartRepo->update($data);
            return;
        }
        $product_ids = empty($user_cart_id)? [] : $this->model->where('cart_id', $user_cart_id)->get()->pluck('product_id')->toArray();

        foreach ($guest_cart_items as $guest_cart_item) {
            // merge case if guest and user cart items have same product
            if (in_array($guest_cart_item->product_id, $product_ids)) {
                $item_to_update = $this->model->where('cart_id', $user_cart_id)->where('product_id', $guest_cart_item->product_id)->first();
                $quantity = $item_to_update->quantity + $guest_cart_item->quantity;
                $quantity = ($guest_cart_item->product->quantity > $quantity) ? $quantity : $guest_cart_item->product->quantity;
                $item_to_update->update(['quantity' => $quantity]);
                $this->model->where('cart_id', $cartId)->where('product_id', $guest_cart_item->product_id)->delete();

            } else {
                $quantity = $guest_cart_item->product->quantity > $guest_cart_item->quantity ? $guest_cart_item->quantity : $guest_cart_item->product->quantity;
                $this->model->where('cart_id', $guest_cart_item->cart_id)
                    ->where('product_id', $guest_cart_item->product_id)
                    ->update(['cart_id' => $user_cart_id, 'quantity' => $quantity]);
            }
        }
    }

    /**
     * @param int $cartId
     * @return self
     */
    public function getCartItemsByCartId($cartId): ?Collection
    {
        return $this->byCartId($cartId)->get();
    }

    /**
     * @param int $id
     * @return self
     */
    protected function byId($id): ?self
    {
        $this->builder = $this->builder->where('id', $id);
        return $this;
    }

    /**
     * @param int $cartId
     * @return self
     */
    protected function byCartId(int $cartId): self
    {
        $this->builder = $this->builder->where('cart_id', $cartId);
        return $this;
    }

    /**
     * @param int $productId
     * @return self
     */
    protected function byProductId(int $productId): self
    {
        $this->builder = $this->builder->where('product_id', $productId);
        return $this;
    }

    /**
     * @return self
     */
    protected function withProducts(): self
    {
        $this->builder = $this->builder->with('product');
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
