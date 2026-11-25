<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Seed dummy users for FlipPlay.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Raka Pratama',
                'email' => 'raka@flipplay.test',
                'password' => 'password123',
            ],
            [
                'name' => 'Nadia Putri',
                'email' => 'nadia@flipplay.test',
                'password' => 'password123',
            ],
            [
                'name' => 'Bima Wijaya',
                'email' => 'bima@flipplay.test',
                'password' => 'password123',
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
