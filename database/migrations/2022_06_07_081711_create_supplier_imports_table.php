<?php

use App\Models\Supplier;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier_imports', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Supplier::class);
            $table->boolean('active')->default(false);
            $table->string('class_name');
            $table->integer('dayOfWeek')->nullable();
            $table->time('timeOfDay')->default('04:00:00');
            $table->dateTime('started_at')->nullable();
            $table->dateTime('finished_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('supplier_imports');
    }
};
