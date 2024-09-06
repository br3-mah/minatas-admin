<?php

namespace Database\Seeders;

use App\Models\LoanWallet;
use App\Models\LoanWalletHistory;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
class WalletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::get();
        //create wallet for organization
        $data = LoanWallet::create([
            'deposit'=> 90000
        ]);
        LoanWalletHistory::create([
            'desc' => 'Initialized Funds',
            'amount' => 90000,
            'user_id' => auth()->user()->id,
            'loan_wallet_id' => $data->id
            ]);

        //Create wallets for existing users
        foreach ($users as $key => $user) {
            Wallet::create([
                'email' => $user->email,
                'user_id' => $user->id,
                'phone' => $user->phone
            ]);
        }


    }
}
