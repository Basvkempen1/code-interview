<?php

namespace App\Models;

use App\Models\Product\Product;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Supplier extends Model
{
    use HasFactory;

    protected $table = 'leveranciers';
    protected $primaryKey = 'lid';
    public $timestamps = false;

    public static function getRelationKey(): string
    {
        return 'supplier_lid';
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'leverancier', 'lid');
    }

    public function supplierImports(): HasMany
    {
        return $this->hasMany(SupplierImport::class);
    }

    public function isActive(): bool
    {
        return ($this->leverancier_actief === 1);
    }


    protected function marketingBijdrage(): Attribute
    {
        return Attribute::make(
            get: static fn($value, $attributes) => ($attributes['marketingBijdrage'] * 100),
            set: static fn($value, $attributes) => [
                'marketingBijdrage' => $value / 100,
            ],
        );
    }

    protected function franco(): Attribute
    {
        return Attribute::make(
            get: static fn($value, $attributes) => ($attributes['franco'] * 100),
            set: static fn($value, $attributes) => [
                'franco' => $value / 100,
            ],
        );
    }

    protected function nettoFactorVoor(): Attribute
    {
        return Attribute::make(
            get: static fn($value, $attributes) => ($attributes['netto_factor_voor'] * 100),
            set: static fn($value, $attributes) => [
                'netto_factor_voor' => ($value / 100),
            ],
        );
    }


    protected function salePct(): Attribute
    {
        return Attribute::make(
            get: static fn($value, $attributes) => ($attributes['sale_pct'] * 100),
            set: static fn($value, $attributes) => [
                'sale_pct' => ($value / 100),
            ],
        );
    }

    protected function stockAdviceFactor(): Attribute
    {
        return Attribute::make(
            get: static fn($value, $attributes) => ($attributes['stock_advice_factor'] * 100),
            set: static fn($value, $attributes) => [
                'stock_advice_factor' => ($value / 100),
            ],
        );
    }
}
