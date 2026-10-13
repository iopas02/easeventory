<?php

namespace Database\Seeders;

use App\Models\SuperAdmin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        SuperAdmin::create([
            'username' => 'superadmin',
            'name' => 'Platform Superadmin',
            'password' => 'password',
        ]);
    }
}
