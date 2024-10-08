<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Store;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name= $this->faker->productName;
        return [
            "name"=>$name,
            "slug"=>STR::slug($name),
            "description"=>$this->faker->sentence(15),
            // "image"=>$this->faker->imageUrl(600,600),
            "price"=>$this->faker->randomFloat(1,1,499),
            "compare_price"=>$this->faker->randomFloat(1,500,999),
            "category_id"=>Category::inRandomOrder()->first()->id,
            "store_id"=>Store::inRandomOrder()->first()->id,
            "featured"=>rand(0,1)
        ];
    }
}
