<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Tabadil',
            'phone' => '01234567890',
            'govern' => 1,
            'type' => 3,
            'status' => 3,
            'password' => '$2y$10$QxOETgD10qwhFi6A22xAsuXzlMi0KDyrg0wGv8.6nXZRI66ksmqEG',
        ]);
    }
}
