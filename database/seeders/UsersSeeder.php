<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    public function run()
    {
        // Admin
        User::factory()->create([
            'email' => 'puppy@betterworld.org',
            'name' => 'Thanh Nguyen',
            'password' => Hash::make('Testing@123'),
        ]);
    }
}
