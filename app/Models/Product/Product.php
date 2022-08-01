<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    const IMAGE_URL = 'https://images.tom.shop/producten';

    /** @var bool */
    public $timestamps = false;
    /** @var string */
    protected $table = 'producten';
    /** @var string */
    protected $primaryKey = 'pid';
    /** @var array */
    protected $guarded = [];

    public function getIdAttribute()
    {
        return $this->pid;
    }

    public function priceMutations(): HasMany
    {
        return $this->hasMany(PriceMutation::class, 'product_id', 'pid');
    }

    public function getLocalNameAttribute(): string
    {
        $fieldNameSuffix = $this->getFieldNameSuffix();

        return Str::ucfirst($this->{'naam' . $fieldNameSuffix});
    }

    private function getFieldNameSuffix(): string
    {
        $fieldNameSuffix = '';
        $locale = App::getLocale();

        if ($locale !== 'nl') {
            $fieldNameSuffix = '_' . $locale;
        }

        return $fieldNameSuffix;
    }
}
