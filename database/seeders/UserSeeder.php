<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'fname' => 'Minatas',
            'lname' => 'Resources',
            'email' => 'admin@minatasresources.com',
            'password' => bcrypt('min@t@2024'),
        ])->assignRole('admin');
    }
}
