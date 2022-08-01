<?php

namespace App\SupplierImports;

interface SupplierImportInterface
{
    public function getExceptions(): array;

    public function shouldRun(): bool;

    public function run(): bool;
}
