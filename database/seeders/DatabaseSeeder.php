<?php

namespace Database\Seeders;

use App\Models\UserJoinRole;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            UnitSeeder::class,
            RegionSeeder::class,
            DistrictSeeder::class,
            OrganizationSeeder::class,
            ManufacturerSeeder::class,
            CustomerSeeder::class,
            BranchSeeder::class,
            ProductSeeder::class,
            InvoiceSeeder::class,
            OrderSeeder::class,
            DebtSeeder::class,
            TreatmentRegimenSeeder::class,
            CartSeeder::class,
            RoleSeeder::class,
            UserJoinRoleSeeder::class,
            ProductJoinInvoiceSeeder::class,
        ]);
    }
}
