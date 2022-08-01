<?php

namespace App\SupplierImports;

use App\SupplierImports\Traits\FromUrl;
use App\SupplierImports\Traits\IsCsv;

class IsCsvFromUrlExample extends BaseSupplier
{

    use IsCsv, FromUrl;

    protected array $fieldMapping = [
        'product_code'      => 'ARTICLE',
        'name_nl'           => 'NAME_NL',
        'name_en'           => 'NAME_EN',
        'name_de'           => 'NAME_DE',
        'name_fr'           => 'NAME_FR',
        'description_nl'    => 'DESCRIPTION_NL',
        'description_en'    => 'DESCRIPTION_EN',
        'description_de'    => 'DESCRIPTION_DE',
        'description_fr'    => 'DESCRIPTION_FR',
        'supplier_in_stock' => 'STOCK',
        'purchase_price'    => 'PRICE',
        'ean'               => 'EAN',
        'brand'             => 'BRAND',
        'packing_unit'      => null,
        'hs_code'           => null,
        'ce_markering'      => null,
        'land_van_herkomst' => null,
    ];


    protected string $fileSourceLocation = 'https://files.horka.com/horkacomplete.csv';

    protected function getPicture($item): string
    {
        return 'https://www.horka.com/media/itemvariants/' . $item['IMAGE_1']
            . ',' . 'https://www.horka.com/media/itemvariants/' . $item['IMAGE_2']
            . ',' . 'https://www.horka.com/media/itemvariants/' . $item['IMAGE_3']
            . ',' . 'https://www.horka.com/media/itemvariants/' . $item['IMAGE_4']
            . ',' . 'https://www.horka.com/media/itemvariants/' . $item['IMAGE_5'];
    }

    protected function getPackingUnit($item): ?int
    {
        return 1;
    }

    protected function getHsCode($item): ?int
    {
        return 123123;
    }

    protected function getCeMarking($item): ?string
    {
        return 'geen';
    }

    protected function getCountryOfOrigin($item): ?string
    {
        return 'nl';
    }

    protected function getVatRate($item): int
    {
        return 21;
    }
}
