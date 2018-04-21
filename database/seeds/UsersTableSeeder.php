<?php

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
      DB::table('users')->insert([
        'first_name' => 'Алексей',
        'last_name' => 'Яковлев',
        'email' => 'yacovlef@gmail.com',
        'password' => Hash::make('yacovlef'),
      ]);
    }
}
