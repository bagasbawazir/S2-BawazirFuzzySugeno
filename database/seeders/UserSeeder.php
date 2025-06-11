<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $user = [
            [
                'fullname' => 'Administrator',
                'username' => 'admin',
                'password' => bcrypt('admin'),
            ],
            [
                'fullname' => 'Employee',
                'username' => 'employee',
                'password' => bcrypt('employee'),
            ],
        ];

        foreach ($user as $value) {
            User::create($value);
        }

        User::factory()->count(10)->create();
    }
}
