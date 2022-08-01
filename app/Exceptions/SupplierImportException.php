<?php

namespace App\Exceptions;

use App\SupplierImports\SupplierImportInterface;
use Exception;
use JetBrains\PhpStorm\Pure;

class SupplierImportException extends Exception
{

    private SupplierImportInterface $supplier;

    public function __construct(SupplierImportInterface $supplier, string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->supplier = $supplier;
    }


    public function sendMail(): void
    {
        // ToDo: implement this method later
        $mailText = $this->getLine();
        // Sent mail with error
    }
}
