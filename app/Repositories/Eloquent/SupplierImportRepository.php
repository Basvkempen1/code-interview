<?php /**
       * @noinspection StaticInvocationViaThisInspection
       */

namespace App\Repositories\Eloquent;

use App\Models\SupplierImport;
use App\Repositories\Contracts\SupplierImportRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class SupplierImportRepository extends BaseRepository implements SupplierImportRepositoryInterface
{

    private SupplierImport $model;

    public function __construct(SupplierImport $model)
    {
        $this->model = $model;
    }

    public function getAllScheduled(): collection
    {
        $imports = $this->model->where('active', true)
            ->where('dayOfWeek', Carbon::now()->dayOfWeek)
            ->where('timeOfDay', '<', Carbon::now()->format('H:i:s'))
            ->where(
                function ($query) {
                    return $query->where('started_at', '<', 'finished_at')
                        ->orWhere(
                            function ($query) {
                                return $query->whereNull('started_at')
                                    ->whereNull('finished_at');
                            }
                        );
                }
            );

        return $imports->get();
    }
}
