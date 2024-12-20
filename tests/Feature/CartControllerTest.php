<?php

namespace Tests\Feature;


use Tests\TestCase;
use Database\Seeders\DatabaseSeeder;
use App\Models\User;
use App\Models\Cart;
use App\Models\Product;

class CartControllerTest extends TestCase
{
    

    protected function setUp(): void
    {
        parent::setUp();
    }

    
    public function test_update_cart_item()
    {
        $user = User::first();

        // Ensure the user exists
        if (!$user) {
            $user = User::factory()->create(['id' => 1]);
        }

        // Ensure the product exists
        $product = Product::firstOrCreate(['id' => 1], [
            'name' => 'Test Product',
            'description' => 'This is a test product.',
            'price' => 100,
        ]);

       

        $response = $this->withoutMiddleware()
            ->actingAs($user)
            ->post('/cart/add', [
                'product_id' => $product->id,
                'quantity' => 2,
            ]);

        // Assert that the response is successful
        $response->assertStatus(200)
                 ->assertJson(['message' => 'Product added to cart']);

        // Assert the cart item has been updated in the database
        $this->assertDatabaseHas('carts', [
            'user_id' => $user->id,
            'product_id' => $product->id,
            'quantity' => 2,
        ]);
    }

    public function test_update_cart_item_not_found()
    {
        $user = User::first();

        // Ensure the user exists
        if (!$user) {
            $user = User::factory()->create(['id' => 1]);
        }

        // Ensure the product exists
        $product = Product::firstOrCreate(['id' => 1], [
            'name' => 'Test Product',
            'description' => 'This is a test product.',
            'price' => 100,
        ]);

        $response = $this->withoutMiddleware()
            ->actingAs($user)
            ->post('/cart/update', [
                'product_id' => 789879,
                'quantity' => 2,
            ]);

        // Assert that the response is not found
        $response->assertStatus(404)
                 ->assertJson(['message' => 'Cart item not found']);
    }

    public function test_remove_cart_item()
    {
        $user = User::first();

        // Ensure the user exists
        if (!$user) {
            $user = User::factory()->create(['id' => 1]);
        }

        // Ensure the product exists
        $product = Product::firstOrCreate(['id' => 1], [
            'name' => 'Test Product',
            'description' => 'This is a test product.',
            'price' => 100,
        ]);
        

        $response = $this->withoutMiddleware()
            ->actingAs($user)
            ->post('/cart/remove', [
                'product_id' => $product->id,
            ]);

        // Assert that the response is successful
        $response->assertStatus(200)
                 ->assertJson(['message' => 'Product removed from cart']);

        // Assert the cart item has been removed from the database
        $this->assertDatabaseMissing('carts', [
            'user_id' => $user->id,
            'product_id' => $product->id,
        ]);
    }

    public function test_remove_cart_item_not_found()
    {
        $user = User::first();

        // Ensure the user exists
        if (!$user) {
            $user = User::factory()->create(['id' => 1]);
        }

        // Ensure the product exists
        $product = Product::firstOrCreate(['id' => 1], [
            'name' => 'Test Product',
            'description' => 'This is a test product.',
            'price' => 100,
        ]);

        $response = $this->withoutMiddleware()
            ->actingAs($user)
            ->post('/cart/remove', [
                'product_id' => 123,
            ]);

        // Assert that the response is not found
        $response->assertStatus(404)
                 ->assertJson(['message' => 'Cart item not found']);
    }
}
