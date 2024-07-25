<?php

declare(strict_types=1);

use App\Models\Product;
use App\Models\User;
use Stripe\StripeClient;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\assertDatabaseCount;

uses(RefreshDatabase::class);

test('can subscribe', function() {
    $stripe = new StripeClient(config('stripe.stripe_secret'));
    $user = User::factory()->create();

    $paymentIntent = $stripe->paymentIntents->create([
        'amount' => '2000',
        'currency' => 'xof',
        'payment_method' => 'pm_card_visa',
        'setup_future_usage' => 'on_session',
    ]);

    $product = Product::factory()->create([
        'stripe_product_id' => 'price_1Pg7ddB9zsxtvrzR5DFr8psE',
        'name'=>  "Offre Basique",
        'price'=> 2000,
    ]);

    // On va se connecter en tant que l'utilisateur
    $response = $this->actingAs($user)->post(route('subscribe.store', [
        'paymentMethod' => $paymentIntent->payment_method,
        'selectedProductId' => $product->id,
    ]));

    // Afficher la réponse pour déboguer
    $response->assertStatus(200);

    // Afficher les erreurs de validation si la réponse n'est pas 200
    if ($response->status() !== 200) {
        dd($response->json());
    }

    // Assert that the subscriptions table contains 1 record
    assertDatabaseCount('subscriptions', 1);
})->only();
