<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin user',
            'email' => 'admin@admin.com ',
            'password' => Hash::make('admin'),
            'role_id' => 1,
        ]);
    }
}
