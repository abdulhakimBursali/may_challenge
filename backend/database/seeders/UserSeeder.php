<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();
        $now = now();

        $users = [
            [
                'name' => 'Ahmet',
                'surname' => 'Ertürk',
                'role_id' => Role::where('name', 'admin')->first()->id,
                'email' => 'ahmet@example.com',
                'phone' => $faker->numerify('###########'),
                'email_verified_at' => now(),
                'password' => bcrypt(123456),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Hakan',
                'surname' => 'Kaya',
                'role_id' => Role::where('name', 'member')->first()->id,
                'email' => 'hakan@example.com',
                'phone' => $faker->numerify('###########'),
                'email_verified_at' => $now,
                'password' => bcrypt(123456),
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        User::insert($users);
    }
}
