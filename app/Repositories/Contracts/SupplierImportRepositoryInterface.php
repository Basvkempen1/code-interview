<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface SupplierImportRepositoryInterface
{
    public function getAllScheduled():collection;
}
