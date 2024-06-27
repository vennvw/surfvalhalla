<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\Hash;

use Illuminate\Database\Seeder;
use App\Models\Surf_Users;
use App\Models\Surf_Maps;
use App\Models\Ratings;
use App\Models\Comments;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // Create 10 users
        // $users = Surf_Users::factory(10)->create();

        // Create 5 maps
        // $maps = Surf_Maps::factory(5)->create();

        // // Create 10 ratings
        // $ratings = Ratings::factory(10)->create();

        // // Create 10 comments
        // $comments = Comments::factory(10)->create();
        Surf_Users::create([
            'Username' => 'rirds_admin',
            'Password' => Hash::make('password123'), // Hash the password
            'Role' => 'admin'
        ]);
    }
}
