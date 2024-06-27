<?php

namespace Database\Factories;

use App\Models\Comments;
use App\Models\Surf_Users;
use App\Models\Surf_Maps;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentsFactory extends Factory
{
    protected $model = Comments::class;

    public function definition()
    {
        return [
            'comment' => $this->faker->sentence,
            'surf_users_id' => Surf_Users::factory(),
            'surf_maps_id' => Surf_Maps::factory(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
