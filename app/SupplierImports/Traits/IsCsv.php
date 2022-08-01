<?php

namespace App\SupplierImports\Traits;

use App\Exceptions\SupplierImportException;
use Illuminate\Support\Facades\Storage;

trait IsCsv
{

    protected array $rawSourceData = [];
    protected string $delimiterCharacter = ',';
    protected string $enclosureCharacter = '"';
    protected int $headerRowNumber = 1;

    /**
     * @throws SupplierImportException
     */
    protected function getRawSourceData(): void
    {
        $this->downloadSourceFile();
        //$this->validateFile() // ToDo: Implement this method for basic CSV validation
        $this->processFile();
    }

    protected function processFile(): void
    {
        $localFileName = $this->supplierImport->id . '.csv';
        $file_handle = fopen(Storage::disk('local')->path($localFileName), 'r');

        $header = [];
        $currentRow = 0;
        while (!feof($file_handle)) {
            $currentRow++;
            if ($this->getHeaderRow() === $currentRow) {
                $header = fgetcsv($file_handle, 0, $this->getDelimiter(), $this->getEnclosure());
                continue;
            }
            $sourceData[] = fgetcsv($file_handle, 0, $this->getDelimiter(), $this->getEnclosure());
        }
        fclose($file_handle);
        foreach ($sourceData as $rowData) {
            if (!is_array($rowData)) {
                continue;
            }
            if (!empty($header)) {
                $rowData = array_combine($header, $rowData);
            }
            $this->rawSourceData[] = $rowData;
        }
    }

    protected function getHeaderRow(): int
    {
        return $this->headerRowNumber;
    }

    protected function getEnclosure(): string
    {
        return $this->enclosureCharacter;
    }

    protected function getDelimiter(): string
    {
        return $this->delimiterCharacter;
    }
}
