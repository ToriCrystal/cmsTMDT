<?php

namespace Database\Seeders;

use App\Models\Product;
use Faker\Factory;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('vi_VN');
        for ($i = 0; $i < 50; $i++) {
            Product::create([
                'store_id' => $faker->numberBetween(1, 2),
                'category_id' => $faker->numberBetween(1, 2),
                'name' => $faker->sentence(3),
                'slug' => $faker->slug,
                'price' => $faker->randomFloat(2, 10, 200),
                'sku' => $faker->bothify('SKU-??????'),
                'manage_stock' => $faker->numberBetween(1,2),
                'qty' => $faker->numberBetween(0, 100),
                'in_stock' => $faker->numberBetween(1,2),
                'status' => $faker->randomElement([1]),
            ]);
        }
    }
}
