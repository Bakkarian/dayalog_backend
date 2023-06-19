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
        Schema::create('dispatches', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_vehicle_id');
            $table->string('origin');
            $table->string('destination');
            $table->string('notes')->nullable();
            $table->enum(
                'status',
                [
                    'not_started',
                    'transit',
                    'reached',
                    'cancelled'
                ]
            )->default('not_started');
            $table->timestamps();
            //TODO: Use ForeignFor instead
            $table->foreign('order_vehicle_id')
                ->references('id')
                ->on('order_vehicle');

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dispatches');
    }
};
