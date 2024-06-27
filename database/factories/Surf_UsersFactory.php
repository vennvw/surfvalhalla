<?php

namespace Database\Factories;

use App\Models\Surf_Users;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class Surf_UsersFactory extends Factory
{
    protected $model = Surf_Users::class;

    public function definition()
    {
        return [
            'Username' => $this->faker->userName,
            'Password' => bcrypt('password'),
            'Role' => $this->faker->randomElement(['admin', 'user']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
