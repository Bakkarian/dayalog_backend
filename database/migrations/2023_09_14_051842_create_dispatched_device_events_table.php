<?php

use App\Models\Device;
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
        Schema::create('dispatched_device_events', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Dispatch::class)->constrained();
            $table->foreignIdFor(Device::class);
            $table->foreignIdFor(DevicePosition::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dispatched_device_events');
    }
};
