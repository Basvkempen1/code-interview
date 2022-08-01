<?php

namespace App\SupplierImports\Traits;

use App\Exceptions\SupplierImportException;
use Illuminate\Support\Facades\Storage;
use Str;

trait FromUrl
{
    private string $fileName;

    /**
     * @throws SupplierImportException
     */
    protected function downloadSourceFile(): void
    {
        $sourceFileLocation = $this->getSourceFileLocation();

        $contents = file_get_contents($sourceFileLocation);
        $fileExtension = pathinfo($sourceFileLocation, PATHINFO_EXTENSION);
        $localFileName = $this->supplierImport->id . '.' . $fileExtension;
        Storage::disk('local')->put($localFileName, $contents);

        $this->fileName = $localFileName;
    }

    /**
     * @throws SupplierImportException
     */
    protected function getSourceFileLocation(): string
    {
        if (!isset($this->fileSourceLocation) || is_null($this->fileSourceLocation)) {
            throw new SupplierImportException($this, 'No file location given. add $fileSourceLocation property or create `getFileLocation` method in supplier import class');
        }
        return $this->fileSourceLocation;
    }
}
