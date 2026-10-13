<?php

namespace Database\Seeders;

use App\Models\SuperAdmin;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     *
     * Each tenant is identified by its email domain. Multiple users may
     * share a domain (e.g. admin@rjbr.com and admin2@rjbr.com), and they
     * all see the same tenant data.
     */
    public function run(): void
    {
        $rjbr = Tenant::create([
            'domain' => 'rjbr.com',
            'name' => 'RJBR Auto Supply',
        ]);

        $gigandjims = Tenant::create([
            'domain' => 'gigandjims.com',
            'name' => 'Gig & Jims Auto Supply',
        ]);

        User::create([
            'tenant_id' => $rjbr->id,
            'name' => 'RJBR Admin',
            'email' => 'admin@rjbr.com',
            'password' => bcrypt('password'),
        ]);

        User::create([
            'tenant_id' => $rjbr->id,
            'name' => 'RJBR Admin 2',
            'email' => 'admin2@rjbr.com',
            'password' => bcrypt('password'),
        ]);

        User::create([
            'tenant_id' => $gigandjims->id,
            'name' => 'Gig & Jims Admin',
            'email' => 'admin@gigandjims.com',
            'password' => bcrypt('password'),
        ]);
    }
}
