<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SupplierImport extends Model
{
    use HasFactory;

    public static function getFirstScheduled(): ?self
    {
        return self::where('active', true)
            ->where('dayOfWeek', Carbon::now()->dayOfWeek)
            ->where('timeOfDay', '<', Carbon::now()->format('H:i:s'))
            ->where(
                function ($query) {
                    return $query->whereColumn('started_at', '<', 'finished_at')
                        ->orWhere(
                            function ($query) {
                                return $query->whereNull('started_at')
                                    ->whereNull('finished_at');
                            }
                        );
                }
            )
            ->orderBy('timeOfDay', 'asc')
            ->take(1)
            ->first();
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }
}
