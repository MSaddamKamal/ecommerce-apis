<?php

namespace Tests\Feature;

use Tests\PassportTestCase;
use Illuminate\Http\Response;
use App\Modules\Checkout\Models\Cart;
use App\Modules\Product\Models\Product;
class AddToCartTest extends PassportTestCase
{
    public function test_creates_a_new_cart_if_cart_does_not_exists_and_add_product(): void
    {
        $exists = Cart::where('user_id', $this->user->id)->exists();
        $this->assertFalse($exists);

        $response = $this->post('/api/cart', ['product_ids' => [Product::first()->id]], $this->headers);
        $response->assertStatus(Response::HTTP_OK);
        $content = json_decode($response->getContent());
        $this->assertDatabaseHas('carts', ['user_id' => $this->user->id]);
        $this->assertDatabaseHas('cart_items', ['cart_id' => $content->data->id, 'product_id' => Product::first()->id]);
    }

    public function test_add_an_item_to_an_existing_cart(): void
    {
        Cart::create(['user_id', $this->user->id]);
        $response = $this->post('/api/cart', ['product_ids' => [Product::first()->id]], $this->headers);
        $response->assertStatus(Response::HTTP_OK);
        $this->assertDatabaseHas('carts', ['user_id' => $this->user->id]);
        $this->assertDatabaseHas('cart_items', ['cart_id' => Cart::where('user_id', $this->user->id)->first()->id, 'product_id' => Product::first()->id]);
    }
}
