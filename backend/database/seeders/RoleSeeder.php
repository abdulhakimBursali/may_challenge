<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = now();
        $roles = [
            [
                'name' => 'admin',
                'description' => 'Yönetici iznine sahip kullanıcılar.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'member',
                'description' => 'Üye kullanıcılar.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        Role::insert($roles);
    }
}
