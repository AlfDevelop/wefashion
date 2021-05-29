<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Product;
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Product::class, 80)->create();
    }
}