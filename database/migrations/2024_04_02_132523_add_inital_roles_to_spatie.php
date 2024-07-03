<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Role;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Role::create(['name' => 'Super User']);

        Role::create(['name' => 'Admin']);

        Role::create(['name' => 'User']);


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Role::findByName('Super User')->delete();

        Role::findByName('Admin')->delete();

        Role::findByName('User')->delete();

        
    }
};
