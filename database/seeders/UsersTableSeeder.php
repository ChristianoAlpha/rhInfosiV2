<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        DB::table('users')->delete();

        DB::table('users')->insert([
                'name' => 'Admin',
                'email' => 'admin2@infosi.gov.ao',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]);
        
        
    }
}