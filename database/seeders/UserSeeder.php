<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
        public function run(): void
    {
        $users = [
             [
                'name' => 'Aden Ragil Masrendra',
                'email' => 'adenragilm@gmail.com',
                'password' => Hash::make('password123'),
                'jabatan' => 'Chief Executive Officer',
                'role_id' => '1',
            ],
            [
                'name' => 'Ahmad Farid',
                'email' => 'ahmadfarid@gmail.com',
                'password' => Hash::make('password123'),
                'jabatan' => 'Chief Technology Officer',
                'role_id' => '2',
            ],
            [
                'name' => 'Budi Santoso',
                'email' => 'budi@example.com',
                'password' => Hash::make('password123'),
                'jabatan' => 'Manager',
                'role_id' => '2',
            ],
            [
                'name' => 'Ani Wijaya',
                'email' => 'ani@example.com',
                'password' => Hash::make('password123'),
                'jabatan' => 'Krani',
                'role_id' => '3',
            ],
            [
                'name' => 'Citra Dewi',
                'email' => 'citra@example.com',
                'password' => Hash::make('password123'),
                'jabatan' => 'Karyawan',
                'role_id' => '3',
            ],
            [
                'name' => 'Dodi Pratama',
                'email' => 'dodi@example.com',
                'password' => Hash::make('password123'),
                'jabatan' => 'Karyawan',
                'role_id' => '3',
            ],
            [
                'name' => 'Eva Susanti',
                'email' => 'eva@example.com',
                'password' => Hash::make('password123'),
                'jabatan' => 'Karyawan',
                'role_id' => '3',
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
