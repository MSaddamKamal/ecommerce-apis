<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Response;
use App\Modules\Checkout\Models\Cart;
use App\Modules\Product\Models\Product;
class GuestAddToCartTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;
    protected $headers = [];
    protected $scopes = [];
    protected $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }
    public function test_guest_creates_a_new_cart_if_cart_does_not_exists_and_add_product(): void
    {
        $response = $this->post('/api/guest/cart', ['product_ids' => [Product::first()->id]]);
        $response->assertStatus(Response::HTTP_OK);
        $content = json_decode($response->getContent());
        $this->assertDatabaseHas('carts', ['user_id' => null]);
        $this->assertDatabaseHas('cart_items', ['cart_id' => $content->data->id, 'product_id' => Product::first()->id]);
    }

    public function test_guest_add_an_item_to_an_existing_cart(): void
    {
        $cart = Cart::create();
        $response = $this->post('/api/guest/cart', ['product_ids' => [Product::first()->id], 'cart_id' => $cart->id], $this->headers);
        $response->assertStatus(Response::HTTP_OK);
        $this->assertDatabaseHas('carts', ['id' => $cart->id]);
        $this->assertDatabaseHas('cart_items', ['cart_id' => $cart->id, 'product_id' => Product::first()->id]);
    }
}
