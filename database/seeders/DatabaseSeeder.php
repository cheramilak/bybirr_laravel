<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $user = User::find(1) ?? new User();
        $user->first_name = 'Admin';
        $user->last_name = 'User';
        $user->email = 'admin@admin.com';
        $user->password = Hash::make('password');
        $user->status = 'Active';
        $user->uuid = \Illuminate\Support\Str::uuid();
        $user->save();
    }
}
