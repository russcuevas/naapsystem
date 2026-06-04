<?php

namespace Database\Seeders;

use App\Models\Superadmin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SuperadminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Superadmin::create([
            'fullname' => 'Superadmin NAAP',
            'contact' => '09495748302',
            'email' => 'naap_authority@gmail.com',
            'password' => bcrypt('123456789'),
        ]);
    }
}
