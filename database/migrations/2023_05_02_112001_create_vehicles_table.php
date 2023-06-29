<?php

use App\Models\Device;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();

            $table->string('vin')->unique();
            $table->string('number_plate')->unique();
            $table->string('make');
            $table->string('model');

            $table->decimal('capacity_weight', 10, 2);
            $table->decimal('capacity_volume', 10, 2);
            $table->boolean('availability')->default(true);
            
            $table->string('insurance_policy_number')->nullable();
            $table->string('insurance_coverage')->nullable();
            $table->date('insurance_expiration')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
