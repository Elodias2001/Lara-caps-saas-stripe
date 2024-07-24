<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Product::factory(2)
        ->sequence(
            [
                'name'=>  "Offre Basique",
                'price'=> "price_1Pg7ddB9zsxtvrzR5DFr8psE",
                "stripe_product_id" => 2000,
            ],[
                'name'=>  "Offre Prémium",
                'price'=> "price_1Pg7h7B9zsxtvrzRUCy3yJdz",
                "stripe_product_id" => 3000,
            ]
            )
        ->create();
    }
}
