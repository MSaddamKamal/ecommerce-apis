<?php

namespace App\Modules\Product\Repositories;

use App\Modules\Checkout\Contracts\CartItemRepositoryContract;
use App\Modules\Common\Repositories\BaseRepository;
use App\Modules\Product\Contracts\ProductRepositoryContract;
use App\Modules\Product\DTO\ProductIndexDTO;
use Illuminate\Support\Collection;
use App\Modules\Product\Models\Product;

class ProductRepository extends BaseRepository implements ProductRepositoryContract
{
    /**
     * @var $builder
     */
    protected $builder;

    /**
     * @var CartItemRepositoryContract
     */
    protected $cartItemRepo;


    /**
     * @param Product $model
     * @param CartItemRepositoryContract $cartItemRepo
     */
    public function __construct(Product $model, CartItemRepositoryContract $cartItemRepo)
    {
        parent::__construct($model);
        $this->builder = $model;
        $this->cartItemRepo = $cartItemRepo;
    }

    /**
     * @param ProductIndexDTO $productIndexDTO
     * @return Collection|null
     */
    public function all(ProductIndexDTO $productIndexDTO): ?Collection
    {

        $cartItems = !$productIndexDTO->cart_id ? [] : $this->cartItemRepo->getCartItemsByCartId($productIndexDTO->cart_id);
        $result = $this->baseAll($productIndexDTO);

        if($result->get('data')) {
            $data = $result->get('data');
            foreach($data as $k => $d) {
                // get quantity added to cart item
                $qty = !empty($cartItems)? $cartItems->where('product_id', $d['id'])->value('quantity') : 0;
                // deducting quantity of cartitem from product original qty
                $qtyLeft = $d['quantity'] - ($qty ?? 0);
                $data[$k]['quantityLeftPerUser'] = $qtyLeft < 0 ? 0 : $qtyLeft;
            }
            $result['data'] = $data;
        }else {
            foreach($result as $k => $d) {
                // get quantity added to cart item
                $qty = !empty($cartItems) ? $cartItems->where('product_id', $d['id'])->value('quantity') : 0;
                // deducting quantity of cartitem from product original qty
                $qtyLeft = $d->quantity - ($qty ?? 0);
                $result[$k]->quantityLeftPerUser = $qtyLeft < 0 ? 0 : $qtyLeft;
            }
        }


        return $result;
    }


    /**
     * @param $id
     * @return $this|null
     */
    protected function byId($id): ?self
    {
        $this->builder = $this->builder->where('id', $id);
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
