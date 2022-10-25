<?php

namespace Database\Seeders;

use App\Models\ProductJoinInvoice;
use Illuminate\Database\Seeder;

class ProductJoinInvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductJoinInvoice::factory(10)->create();
    }
}