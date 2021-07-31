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
//            'name' => 'admin',
            'name' => 'user',
//            'email' => 'admin@admin.com',
            'email' => str_random(4).'@admin.com',
            'password' => Hash::make('admin'),
            'type' => 2,
        ]);
    }
}
