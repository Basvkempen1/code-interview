<?php

namespace Database\Factories;

use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SupplierImport>
 */
class SupplierImportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        $startTime = $this->faker->dateTimeBetween('- 120 minutes', '+ 120 minutes');
        $endTime = Carbon::parse($startTime)->addMinutes($this->faker->numberBetween(1, 120));

        return [
            'supplier_lid'              => Supplier::factory()->create()->lid,
            'active'                    => $this->faker->boolean,
            'class_name'                => 'is_csv_from_url_example',
            'dayOfWeek'                 => $this->faker->numberBetween(0, 6),
            'timeOfDay'                 => $this->faker->time(),
            'started_at'                => $startTime,
            'finished_at'               => $endTime,
        ];
    }
}
