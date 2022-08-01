<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PriceMutation extends Model
{
    use HasFactory;

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'pid', 'product_id');
    }

    public function getWentUpAttribute(): bool
    {
        if ($this->new_price > $this->old_price) {
            return true;
        }

        return false;
    }

    public function getWentDownAttribute(): bool
    {
        if ($this->new_price < $this->old_price) {
            return true;
        }

        return false;
    }
}
