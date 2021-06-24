<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserAccount extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'last_name' => 'Backian',
            'first_name' => 'Ian Jones',
            'middle_name' => 'Bulasao',
            'username' => 'jbaki',
            'person_contactnum' => '09091234567',
            'password' => Hash::make('qwerty'),
            'user_role' => 'admin',
            'account_status' => 1,
            'created_at' => Carbon::now()
        ]);
    }
}
