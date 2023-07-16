<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Modules\Product\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Create fake Products In DB
        for($i=0;$i<10;$i++){
            $data = [
                "name" => $faker->unique()->name(),
                "sku" => Str::upper(Str::random(4)),
                "image_url" => $faker->imageUrl(150, 150, gray: true),
                "price" => $faker->numberBetween(1, 200),
                "quantity" => $faker->numberBetween(1, 20),
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now()
            ];

            Product::insert($data);
        }
    }
}
