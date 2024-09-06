<?php
namespace Database\Seeders;

use App\Models\Application;
use App\Models\ApplicationStage;
use App\Models\LoanStatus;
use App\Models\ServiceCharge;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LoanApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'fname' => 'Bremah',
            'lname' => 'George',
            'email' => 'nyeleti.bremah@gmail.com',
            'phone' => '0772147755',
            'password' => bcrypt('2024'),
        ])->assignRole('user');
        $user = User::create([
            'fname' => 'Mateo',
            'lname' => 'Chalwe Chama',
            'email' => 'georgemunganga@gmail.com',
            'phone' => '0772147755',
            'password' => bcrypt('capex+1234'),
        ])->assignRole('user');

        $app = Application::create([
            'repayment_plan' => 1,
            'amount' => 5000,
            'status' => 0,
            'user_id' => $user->id,
            'can_change' => 1,
            'complete' => 1,
            'nationality' => 'Yes',
            'continue' => 0,
            'is_assigned' => 0,
            'loan_product_id' => 1,
            'loan_child_type_id' => 1,
            'loan_type_id' => 1
        ]);

        ApplicationStage::create([
            'application_id' => $app->id,
            'loan_status_id' => 1,
            'state' => 'current',
            'status' => 'verification',
            'stage' => 'processing',
            'prev_status' => 'current',
            'curr_status' => '',
            'position'=>1
        ]);
    }
}


