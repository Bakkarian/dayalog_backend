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
        // Declare variables for table names and database
        $tracarDatabase = DB::connection('traccar')->getDatabaseName();
        $dayalogDatabase = DB::connection()->getDatabaseName();
        $tcPositionsTable = $tracarDatabase . '.tc_positions';
        $positionsTable = $dayalogDatabase . '.device_positions';

        // Create dayalog.positions table
        DB::unprepared("CREATE TABLE IF NOT EXISTS $positionsTable LIKE $tcPositionsTable");

        // Copy existing data
        DB::unprepared("INSERT INTO $positionsTable SELECT * FROM $tcPositionsTable");

        // Create trigger for INSERT operation
        DB::connection('traccar')->unprepared("
            CREATE TRIGGER tracar_tc_positions_insert_trigger
            AFTER INSERT ON $tcPositionsTable
            FOR EACH ROW
            BEGIN
                INSERT INTO $positionsTable
                SELECT * FROM $tcPositionsTable WHERE id = NEW.id;
            END
        ");

        // Create trigger for UPDATE operation
        DB::connection('traccar')->unprepared("
            CREATE TRIGGER tracar_tc_positions_update_trigger
            AFTER UPDATE ON $tcPositionsTable
            FOR EACH ROW
            BEGIN
                UPDATE $positionsTable
                SET protocol = NEW.protocol ,
                deviceid = NEW.deviceid ,
                devicetime = NEW.devicetime ,
                fixtime = NEW.fixtime ,
                valid = NEW.valid ,
                latitude = NEW.latitude ,
                longitude = NEW.longitude ,
                altitude = NEW.altitude,
                speed = NEW.speed ,
                course = NEW.course ,
                address = NEW.address ,
                attributes = NEW.attributes ,
                accuracy = NEW.accuracy ,
                network = NEW.network
            WHERE id = NEW.id;
            END
        ");

        // Create trigger for DELETE operation
        DB::connection('traccar')->unprepared("
            CREATE TRIGGER tracar_tc_positions_delete_trigger
            AFTER DELETE ON $tcPositionsTable
            FOR EACH ROW
            BEGIN
                DELETE FROM $positionsTable WHERE id = OLD.id;
            END
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop triggers
        DB::connection('traccar')->unprepared('DROP TRIGGER IF EXISTS tracar_tcce_positions_insert_trigger');
        DB::connection('traccar')->unprepared('DROP TRIGGER IF EXISTS tracar_tc_positions_update_trigger');
        DB::connection('traccar')->unprepared('DROP TRIGGER IF EXISTS tracar_tc_positions_delete_trigger');

        // Drop tables
        Schema::dropIfExists('device_positions');
    }
};

