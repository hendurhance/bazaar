<?php

namespace Database\Seeders;

use App\Models\PayoutMethod;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PayoutMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create a payout method for each user
        User::all()->each(function (User $user) {
            $user->payoutMethods()->saveMany(
                PayoutMethod::factory()->count(rand(1, 3))->make()
            );
        });
    }
}
