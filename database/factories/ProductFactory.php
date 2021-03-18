<?php

namespace Database\Factories;

use App\Models\Mark;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'size_id' => Size::inRandomOrder()->first(),
            'mark_id' => Mark::inRandomOrder()->first(),
            'name' => $this->faker->word,
            'quantity' => $this->faker->numberBetween(1,50),
            'date_shipment' => $this->faker->date(),
            'observation' => $this->faker->sentence,
        ];
    }
}
