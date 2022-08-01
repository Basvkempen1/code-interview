<?php

namespace Database\Seeders;

use App\Models\Supplier;
use App\Models\SupplierImport;
use Exception;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run(): void
    {

        Supplier::factory()->count(30)->create()->each(function($supplier) {
            /** @var Supplier $supplier */
            $numberOfImports = random_int(0, 3);
            SupplierImport::factory()->count($numberOfImports)->create([
                'supplier_lid' => $supplier->getKey(),
            ]);
        });
    }
}
