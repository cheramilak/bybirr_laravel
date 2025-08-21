<?php

namespace Database\Seeders;

use App\Models\TransactionRate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransationRateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rate = TransactionRate::find(1) ?? new TransactionRate();
        $rate->rate = 150;
        $rate->max = 100;
        $rate->min = 5;
        $rate->status = 'Active';
        $rate->save();
    }
}
