<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'fname' => 'Karen',
            'lname' => 'Doe',
            'phone' => '068770022',
            'email' => 'employee@capex.com',
            'password' => bcrypt('capex+1234'),
        ])->assignRole('loan officer');

        User::create([
            'fname' => 'Dan',
            'lname' => 'Maxwell',
            'phone' => '077000022',
            'email' => 'employee2@capex.com',
            'password' => bcrypt('capex+1234'),
        ])->assignRole('operations manager');
    }
}
