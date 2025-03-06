<?php

use App\Models\Device;
use App\Models\Organization;
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
        Schema::create('device_organization', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Device::class);
            $table->foreignIdFor(Organization::class);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('device_organization');
    }
};
