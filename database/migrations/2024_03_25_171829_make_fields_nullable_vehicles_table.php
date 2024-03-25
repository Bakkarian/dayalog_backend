<?php

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
        Schema::table('vehicles', function (Blueprint $table) {

            $table->string('vin')->nullable()->change();
            $table->string('make')->nullable()->change();
            $table->string('model')->nullable()->change();

            $table->decimal('capacity_weight', 10, 2)->nullable()->change();
            $table->decimal('capacity_volume', 10, 2)->nullable()->change();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->string('vin')->nullable(false)->change();
            $table->string('make')->nullable(false)->change();
            $table->string('model')->nullable(false)->change();

            $table->decimal('capacity_weight', 10, 2)->nullable(false)->change();
            $table->decimal('capacity_volume', 10, 2)->nullable(false)->change();
        });
    }
};
