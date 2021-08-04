<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        User::query()->insert([
            'name' => 'admin',
//            'name' => 'user',
            'email' => 'admin@admin.com',
            'number_of_drinks' => 1000,
            'password' => Hash::make('admin'),
            'type' => 1,
        ]);
    }
}
