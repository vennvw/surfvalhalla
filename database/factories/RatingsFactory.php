<?php

namespace Database\Factories;

use App\Models\Ratings;
use App\Models\Surf_Users;
use App\Models\Surf_Maps;
use Illuminate\Database\Eloquent\Factories\Factory;

class RatingsFactory extends Factory
{
    protected $model = Ratings::class;

    public function definition()
    {
        return [
            'Map' => $this->faker->word,
            'Star_Value' => $this->faker->numberBetween(1, 5),
            'surf_users_id' => Surf_Users::factory(),
            'surf_maps_id' => Surf_Maps::factory(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
