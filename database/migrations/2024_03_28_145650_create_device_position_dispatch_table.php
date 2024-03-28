<?php

use App\Models\DevicePosition;
use App\Models\Dispatch;
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
        Schema::create('device_position_dispatch', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Dispatch::class);
            $table->foreignIdFor(DevicePosition::class);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('device_position_dispatch');
    }
};
