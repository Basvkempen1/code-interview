<?php

namespace App\Exceptions;

use Exception;

class SupplierImportItemValidationException extends SupplierImportException
{

    private array $errorMessages;

    public function setErrorMessages($errorMessages): void
    {
        $this->errorMessages = $errorMessages;
    }

    public function getErrorMessages(): array
    {
        return $this->errorMessages;
    }
}
