<?php

namespace Database\Seeders;

use App\Models\TreatmentRegimen;
use Illuminate\Database\Seeder;

class TreatmentRegimenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TreatmentRegimen::factory(10)->create();
    }
}
