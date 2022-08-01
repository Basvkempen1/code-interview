<?php

namespace App\Console\Commands;

use App\Models\SupplierImport;
use App\SupplierImports\SupplierImportInterface;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class SupplierDataImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'suppliers:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Starts suppliers import';

    /**
     * Execute the console command.
     *
     * @return int
     *
     */
    public function handle()
    {
        // get supplier who needs importing

        $supplierImport = SupplierImport::getFirstScheduled();

        if (is_null($supplierImport)) {
            $this->error('No imports found!');
            return 1;
        }

        $supplierClassName = 'App\SupplierImports\\' . Str::camel($supplierImport->class_name);

        if (!class_exists($supplierClassName)) {
            $this->error($supplierClassName . ' Not Found!');
            return 1;
        }

        /** @var SupplierImportInterface $supplierImportClass */
        $supplierImportClass = new $supplierClassName($supplierImport);
        if ($supplierImportClass->shouldRun()) {
            try {
                $supplierImportClass->run();
                if (!empty($supplierImportClass->getExceptions())) {
                    $this->error('The following errors occurred');
                    foreach ($supplierImportClass->getExceptions() as $exception) {
                        $this->error($exception->getMessage());
                    }
                }
            } catch (\Exception $e) {
                $this->error('something went wrong');
                $this->error($e->getMessage());
            }
        }
        return 0;
    }
}
