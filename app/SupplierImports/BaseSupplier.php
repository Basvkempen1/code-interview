<?php

namespace App\SupplierImports;

use App\Exceptions\SupplierImportException;
use App\Exceptions\SupplierImportItemValidationException;
use App\Models\Supplier;
use App\Models\SupplierImport;
use App\Models\SupplierProductData;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\Types\Boolean;
use Psy\Readline\Hoa\Console;
use Str;
use Symfony\Component\Console\Output\Output;

class BaseSupplier implements SupplierImportInterface
{
    protected array $fieldMapping = [
        'product_code'                 => null,
        'ean'                          => null,
        'assortment'                   => null,
        'supplier_in_stock'            => null,
        'supplier_sku'                 => null,
        'hs_code'                      => null,
        'ce_marking'                   => null,
        'brand'                        => null,
        'name'                         => null,
        'description'                  => null,
        'diameter'                     => null,
        'instruction_pdf'              => null,
        'packing_length'               => null,
        'packing_width'                => null,
        'packing_height'               => null,
        'packing_weight'               => null,
        'packing_material'             => null,
        'exclude_selling_countries'    => null,
        'exclude_selling_marketplaces' => null,
        'quality_mark'                 => null,
        'purchase_price'               => null,
        'purchase_unit'                => null,
        'purchase_unit_price'          => null,
        'packing_unit'                 => null,
        'picture'                      => null,
        'video'                        => null,
        'vat_rate'                     => null,
        'advisory_price'               => null,
        'sale_price'                   => null,
        'length'                       => null,
        'width'                        => null,
        'height'                       => null,
        'weight'                       => null,
        'number_of_batteries'          => null,
        'chemical_compound'            => null,
        'country_of_origin'            => null,
        'add_date'                     => null,
        'modify_date'                  => null,
    ];

    protected Collection $sourceDataCollection;
    private array $exceptions;

    public function __construct(SupplierImport $supplierImport)
    {
        $this->supplierImport = $supplierImport;
    }

    /**
     * @throws SupplierImportException
     */
    public function run(): bool
    {
        //$this->backupSourceFile(); // Not fully implemented yet!
        if (!method_exists($this, 'getRawSourceData')) {
            throw new SupplierImportException($this, 'getRawSourceData method is missing. Did you use a valid trait in the supplier import class?');
        }
        $this->getRawSourceData();
        $this->sourceDataCollection = collect($this->rawSourceData);
        //$this->validateData(); // Not fully implemented yet!
        $this->saveData();
        return true;
    }

    public function getExceptions(): array
    {
        return $this->exceptions;
    }

    public function shouldRun(): bool
    {
        if ($this->supplierImport->supplier->isActive()) {
            return true;
        }

        return false;
    }

    private function saveData(): void
    {
        foreach ($this->sourceDataCollection as $item) {
            try {
                $rowsImported = 0;

                $item = $this->sanitizeData($item);

                // We need to convert this data to the OLD database here
                $dataRow = [];
                $dataRow['leverancier_id'] = $this->supplierImport->supplier_lid;
                $dataRow['artikelcode'] = $this->getArticleCode($item);
                $dataRow['leverancier_sku'] = $this->getSupplierSku($this->mapItem($item));
                $dataRow['leverancier_voorradig'] = $this->getSupplierInStock($this->mapItem($item)); // We need this one ?
                $dataRow['assorti'] = $this->getAssorti($this->mapItem($item));
                $dataRow['eancode'] = $this->getEan($this->mapItem($item));
                $dataRow['leverancier_eancode'] = ''; // We need this one ?
                $dataRow['hscode'] = $this->getHsCode($this->mapItem($item));
                $dataRow['ce_marking'] = $this->getCeMarking($this->mapItem($item));
                $dataRow['auteurs'] = ''; // We need this one ?
                $dataRow['merk'] = $this->getBrand($this->mapItem($item));
                $dataRow['naam'] = $this->getNameNl($this->mapItem($item));
                $dataRow['naam_de'] = $this->getNameDe($this->mapItem($item));
                $dataRow['naam_en'] = $this->getNameEn($this->mapItem($item));
                $dataRow['naam_es'] = '';
                $dataRow['naam_fr'] = $this->getNameFr($this->mapItem($item));
                $dataRow['naam_pl'] = '';
                $dataRow['omschrijving'] = $this->getDescriptionNl($this->mapItem($item));
                $dataRow['omschrijving_de'] = $this->getDescriptionDe($this->mapItem($item));
                $dataRow['omschrijving_en'] = $this->getDescriptionEn($this->mapItem($item));
                $dataRow['omschrijving_es'] = '';
                $dataRow['omschrijving_fr'] = $this->getDescriptionFr($this->mapItem($item));
                $dataRow['omschrijving_pl'] = '';
                $dataRow['diameter'] = $this->getDiameter($this->mapItem($item));
                $dataRow['instruction_pdf'] = $this->getInstructionPdf($this->mapItem($item));
                $dataRow['packing_length'] = $this->getPackingLength($this->mapItem($item));
                $dataRow['packing_width'] = $this->getPackingWidth($this->mapItem($item));
                $dataRow['packing_height'] = $this->getPackingHeight($this->mapItem($item));
                $dataRow['packing_weight'] = $this->getPackingWeight($this->mapItem($item));
                $dataRow['packing_material'] = $this->getPackingMaterial($this->mapItem($item));
                $dataRow['exclude_selling_countries'] = $this->getExcludeSellingCountries($this->mapItem($item));
                $dataRow['exclude_selling_marketplaces'] = $this->getExcludeSellingMarketplaces($this->mapItem($item));
                $dataRow['qualitymark'] = $this->getqualityMark($this->mapItem($item));
                $dataRow['inkoopprijs'] = $this->getPurchasePrice($this->mapItem($item));
                $dataRow['prijs_van'] = $this->getAdvisoryPrice($this->mapItem($item));
                $dataRow['prijs_voor'] = $this->getSalePrice($this->mapItem($item));
                $dataRow['compensatieprijs'] = 0;
                $dataRow['btwtarief'] = $this->getVatRate($this->mapItem($item));
                $dataRow['besteleenheid'] = $this->getPurchaseUnit($this->mapItem($item));
                $dataRow['besteleenheid_prijs'] = $this->getPurchaseUnitPrice($this->mapItem($item));
                $dataRow['verpakkingseenheid'] = $this->getPackingUnit($this->mapItem($item));
                $dataRow['foto'] = $this->getPicture($this->mapItem($item));
                $dataRow['video'] = $this->getVideo($this->mapItem($item));
                $dataRow['lp_voorraad'] = '';
                $dataRow['lp_voorraad_min'] = '';
                $dataRow['lp_voorraad_max'] = '';
                $dataRow['length'] = $this->getLength($this->mapItem($item));
                $dataRow['width'] = $this->getWidth($this->mapItem($item));
                $dataRow['height'] = $this->getHeight($this->mapItem($item));
                $dataRow['gewicht'] = $this->getWeight($this->mapItem($item));
                $dataRow['number_of_included_batteries'] = $this->getNumberOfIncludedBatteries($this->mapItem($item));
                $dataRow['chemical_compound'] = $this->getChemicalCompound($this->mapItem($item));
                $dataRow['battery_iec_code'] = '';
                $dataRow['land_van_herkomst'] = $this->getCountryOfOrigin($this->mapItem($item));
                $dataRow['add_date'] = $this->getAddDate($this->mapItem($item));
                $dataRow['modify_date'] = $this->getModifyDate($this->mapItem($item));

                $this->validateData($dataRow);

                SupplierProductData::updateOrCreate(
                    [
                        'leverancier_id' => $dataRow['leverancier_id'],
                        'artikelcode' => $dataRow['artikelcode']
                    ],
                    $dataRow
                );


                $rowsImported++;
            } catch (SupplierImportItemValidationException $e) {
                $this->exceptions[] = $e;
            } catch (SupplierImportException $e) {
                // Silent catch for now
            }
        }
    }

    protected function mapItem($item)
    {
        if (isset(self::$fieldMapping) && !empty(self::$fieldMapping)) {
            foreach (self::$fieldMapping as $newKey => $oldKey) {
                if (array_key_exists($oldKey, $item)) {
                    $item[$newKey] = $item[$oldKey];
                    unset($item[$oldKey]);
                }
            }
        }
        return $item;
    }

    private function backupSourceFile(): bool
    {
        return true;
    }

    /**
     * @throws SupplierImportItemValidationException
     */
    private function validateData($item): void
    {
        $validationRules = [
            'artikelcode'                  => ['required', 'max:255'],
            'eancode'                      => ['required', 'string', 'digits:13'],
            'merk'                         => ['required', 'string', 'max:255'],
            'naam_en'                      => ['nullable', 'required_without:naam', 'string', 'max:255'],
            'naam'                         => ['nullable', 'required_without:naam_en', 'string', 'max:255'],
            'inkoopprijs'                  => ['required', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/', 'min:0.01'],
            'verpakkingseenheid'           => ['required', 'integer', 'min:1'],
            'omschrijving_en'              => ['nullable', 'required_without:omschrijving', 'string'],
            'omschrijving'                 => ['nullable', 'required_without:omschrijving_en', 'string'],
            'hscode'                       => ['required', 'integer'],
            'ce_marking'                   => ['required', 'string', 'max:255',],
            'land_van_herkomst'            => ['required', 'alpha', 'size:2'],
            'foto'                         => ['nullable', 'string'],
            'gewicht'                      => ['nullable', 'integer', 'min:0.5'],
            'length'                       => ['nullable', 'integer'],
            'width'                        => ['nullable', 'integer'],
            'height'                       => ['nullable', 'integer'],
            'diameter'                     => ['nullable', 'integer'],
            'naam_de'                      => ['nullable', 'string', 'max:255'],
            'naam_fr'                      => ['nullable', 'string', 'max:255'],
            'naam_es'                      => ['nullable', 'string', 'max:255'],
            'naam_pl'                      => ['nullable', 'string', 'max:255'],
            'omschrijving_de'              => ['nullable', 'string'],
            'omschrijving_fr'              => ['nullable', 'string'],
            'omschrijving_es'              => ['nullable', 'string'],
            'omschrijving_pl'              => ['nullable', 'string'],
            'besteleenheid'                => ['nullable', 'integer', 'min:1'],
            'besteleenheid_prijs'          => ['nullable', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/'],
            'instruction_pdf'              => ['nullable', 'url'],
            'video'                        => ['nullable', 'url'],
            'packing_length'               => ['nullable', 'integer'],
            'packing_width'                => ['nullable', 'integer'],
            'packing_height'               => ['nullable', 'integer'],
            'packing_weight'               => ['nullable', 'integer'],
            'lp_voorraad'                  => ['nullable', 'integer'],
            'qualitymark'                  => ['nullable', 'string'],
            'exclude_selling_countries'    => ['nullable', 'string'],
            'exclude_selling_marketplaces' => ['nullable', 'string'],
        ];

        $validator = Validator::make($item, $validationRules);

        if ($validator->fails()) {
            $messages = [];
            foreach ($validator->messages()->all() as $message) {
                $messages[] = $message;
            }
            $exception = new SupplierImportItemValidationException($this, 'Item validation failed');
            $exception->setErrorMessages($messages);
            throw $exception;
        }
    }

    private function sanitizeData(mixed $item): mixed
    {
        // ToDo: implement sanitation logic here.
        return $item;
    }

    protected function getFieldValue($key, $item): mixed
    {
        $value = null;
        if (isset($this->fieldMapping[$key]) && !is_null($this->fieldMapping[$key])) {
            $key = $this->fieldMapping[$key];
        }
        if (isset($item[$key])) {
            $value = $item[$key];
        }

        return $value;
    }

    protected function getModifyDate($item): ?string
    {
        $value = $this->getFieldValue('modify_date', $item);
        if (is_null($value)) {
            $value = now();
        }
        return $value;
    }

    protected function getAddDate($item): ?string
    {
        $value = $this->getFieldValue('add_date', $item);
        if (is_null($value)) {
            $value = now();
        }
        return $value;
    }

    protected function getCountryOfOrigin($item): ?string
    {
        return $this->getFieldValue('country_of_origin', $item);
    }

    protected function getChemicalCompound($item): ?int
    {
        return (int)$this->getFieldValue('chemical_compound', $item);
    }

    protected function getNumberOfIncludedBatteries($item): ?int
    {
        return (int)$this->getFieldValue('number_of_batteries', $item);
    }

    protected function getWeight($item): ?int
    {
        return $this->getFieldValue('weight', $item);
    }

    protected function getHeight($item): ?int
    {
        return $this->getFieldValue('height', $item);
    }

    protected function getWidth($item): ?int
    {
        return $this->getFieldValue('width', $item);
    }

    protected function getLength($item): ?int
    {
        return $this->getFieldValue('length', $item);
    }

    protected function getVideo($item): ?string
    {
        return $this->getFieldValue('video', $item);
    }

    protected function getPicture($item): ?string
    {
        return $this->getFieldValue('picture', $item);
    }

    protected function getPackingUnit($item): ?int
    {
        return $this->getFieldValue('packing_unit', $item);
    }

    protected function getPurchaseUnitPrice($item): ?float
    {
        return $this->getFieldValue('purchase_unit_price', $item);
    }

    protected function getPurchaseUnit($item): ?int
    {
        $value = $this->getFieldValue('purchase_unit', $item);
        if ($value < 1) {
            $value = 1;
        }
        return $value;
    }

    protected function getPurchasePrice($item): ?float
    {
        return (float)$this->getFieldValue('purchase_price', $item);
    }

    protected function getqualityMark($item): ?string
    {
        return $this->getFieldValue('quality_mark', $item);
    }

    protected function getExcludeSellingMarketplaces($item): ?string
    {
        return $this->getFieldValue('exclude_selling_marketplaces', $item);
    }

    protected function getExcludeSellingCountries($item): ?string
    {
        return $this->getFieldValue('exclude_selling_countries', $item);
    }

    protected function getPackingMaterial($item): ?string
    {
        return $this->getFieldValue('packing_material', $item);
    }

    protected function getPackingWeight($item): ?int
    {
        return (int)$this->getFieldValue('packing_weight', $item);
    }

    protected function getPackingHeight($item): ?int
    {
        return (int)$this->getFieldValue('packing_height', $item);
    }

    protected function getPackingWidth($item): ?int
    {
        return (int)$this->getFieldValue('packing_width', $item);
    }

    protected function getPackingLength($item): ?int
    {
        return (int)$this->getFieldValue('packing_length', $item);
    }

    protected function getInstructionPdf($item): ?string
    {
        return $this->getFieldValue('instruction_pdf', $item);
    }

    protected function getDiameter($item): ?int
    {
        return (int)$this->getFieldValue('diameter', $item);
    }

    private function getDescriptionNl($item): ?string
    {
        return utf8_encode($this->getFieldValue('description_nl', $item));
    }

    private function getDescriptionEn($item): ?string
    {
        $value = $this->getFieldValue('description_en', $item);
        if (is_null($value)) {
            $value = '';
        }
        return utf8_encode($value);
    }

    private function getDescriptionDe($item): ?string
    {
        return utf8_encode($this->getFieldValue('description_de', $item));
    }

    private function getDescriptionFr($item): ?string
    {
        return utf8_encode($this->getFieldValue('description_fr', $item));
    }

    protected function getNameNl($item): ?string
    {
        return utf8_encode($this->getFieldValue('name_nl', $item));
    }

    protected function getNameEn($item): ?string
    {
        return utf8_encode($this->getFieldValue('name_en', $item));
    }

    protected function getNameDe($item): ?string
    {
        return utf8_encode($this->getFieldValue('name_de', $item));
    }

    protected function getNameFr($item): ?string
    {
        return utf8_encode($this->getFieldValue('name_fr', $item));
    }

    protected function getBrand($item): ?string
    {
        return $this->getFieldValue('brand', $item);
    }

    protected function getCeMarking($item): ?string
    {
        return $this->getFieldValue('ce_marking', $item);
    }

    protected function getHsCode($item): ?int
    {
        return (int)$this->getFieldValue('hs_code', $item);
    }

    protected function getArticleCode($item): ?string
    {
        return $this->getFieldValue('product_code', $item);
    }

    protected function getAssorti($item): ?int
    {
        $value =  $this->getFieldValue('assortment', $item);
        if (is_null($value)) {
            $value = 0;
        }
        return (int)$value;
    }

    protected function getSupplierInStock($item): ?int
    {
        $value = $this->getFieldValue('supplier_in_stock', $item);
        if (is_null($value)) {
            $value = 0;
        }
        return (int)$value;
    }

    protected function getProductCode($item): ?string
    {
        return $this->getFieldValue('productCode', $item);
    }

    protected function getEan($item): ?string
    {
        return $this->getFieldValue('ean', $item);
    }

    protected function getSupplierSku($item): ?string
    {
        $value = $this->getFieldValue('supplier_sku', $item);
        if (is_null($value)) {
            $value = '';
        }
        return $value;
    }

    protected function getVatRate($item): int
    {
        $value = $this->getFieldValue('vat_rate', $item);
        if (is_null($value)) {
            $value = 21;
        }
        return (int)$value;
    }

    private function getAdvisoryPrice($item): float
    {
        $value = $this->getFieldValue('advisory_price', $item);
        if (is_null($value)) {
            $value = 0.00;
        }
        return (float)$value;
    }

    private function getSalePrice($item): float
    {
        $value = $this->getFieldValue('sale_price', $item);
        if (is_null($value)) {
            $value = 0.00;
        }
        return (float)$value;
    }
}
