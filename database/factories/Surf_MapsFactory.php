<?php

namespace Database\Factories;

use App\Models\Surf_Maps;
use Illuminate\Database\Eloquent\Factories\Factory;

class Surf_MapsFactory extends Factory
{
    protected $model = Surf_Maps::class;

    public function definition()
    {
        return [
            'Name' => $this->faker->word,
            'Image' => $this->faker->image(null, 640, 480, null, false),
            'Status' => $this->faker->randomElement(['active', 'inactive']),
            'Tier' => $this->faker->numberBetween(1, 5),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
