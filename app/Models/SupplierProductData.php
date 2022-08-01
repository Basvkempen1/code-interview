<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class SupplierProductData extends Model
{

    protected $table = 'leverancier_productdata';
    protected $guarded = [];



    protected function inkoopPrijs(): Attribute
    {
        return Attribute::make(
            get: static fn($value, $attributes) => $attributes['inkoopprijs'] * 100,
            set: static fn($value, $attributes) => [
                'inkoopprijs' => $value / 100,
            ],
        );
    }

    protected function compensatiePrijs(): Attribute
    {
        return Attribute::make(
            get: static fn($value, $attributes) => $attributes['compensatieprijs'] * 100,
            set: static fn($value, $attributes) => [
                'compensatieprijs' => ($value / 100),
            ],
        );
    }


    protected function besteleenheidPrijs(): Attribute
    {
        return Attribute::make(
            get: static fn($value, $attributes) => $attributes['besteleenheid_prijs'] * 100,
            set: static fn($value, $attributes) => [
                'besteleenheid_prijs' => $value / 100,
            ],
        );
    }


    protected function prijsVan(): Attribute
    {
        return Attribute::make(
            get: static fn($value, $attributes) => $attributes['prijs_van'] * 100,
            set: static fn($value, $attributes) => [
                'prijs_van' => $value / 100,
            ],
        );
    }

    protected function prijsVoor(): Attribute
    {
        return Attribute::make(
            get: static fn($value, $attributes) => $attributes['prijs_voor'] * 100,
            set: static fn($value, $attributes) => [
                'prijs_voor' => $value / 100,
            ],
        );
    }
}
