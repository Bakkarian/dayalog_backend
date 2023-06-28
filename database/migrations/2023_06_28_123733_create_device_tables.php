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
        $tcDevicesTable = $tracarDatabase . '.tc_devices';
        $devicesTable = $dayalogDatabase . '.devices';

        // Create dayalog.devices table
        DB::unprepared("CREATE TABLE IF NOT EXISTS $devicesTable LIKE $tcDevicesTable");

        // Copy existing data
        DB::unprepared("INSERT INTO $devicesTable SELECT * FROM $tcDevicesTable");

        // Create trigger for INSERT operation
        DB::connection('traccar')->unprepared("
            CREATE TRIGGER tracar_tc_devices_insert_trigger
            AFTER INSERT ON $tcDevicesTable
            FOR EACH ROW
            BEGIN
                INSERT INTO $devicesTable
                SELECT * FROM $tcDevicesTable WHERE id = NEW.id;
            END
        ");

        // Create trigger for UPDATE operation
        DB::connection('traccar')->unprepared("
            CREATE TRIGGER tracar_tc_devices_update_trigger
            AFTER UPDATE ON $tcDevicesTable
            FOR EACH ROW
            BEGIN
                UPDATE $devicesTable
                SET name = NEW.name, uniqueid = NEW.uniqueid, lastupdate = NEW.lastupdate,
                    positionid = NEW.positionid, groupid = NEW.groupid, attributes = NEW.attributes,
                    phone = NEW.phone, model = NEW.model, contact = NEW.contact, category = NEW.category,
                    disabled = NEW.disabled, status = NEW.status, geofenceids = NEW.geofenceids,
                    expirationtime = NEW.expirationtime, motionstate = NEW.motionstate, motiontime = NEW.motiontime,
                    motiondistance = NEW.motiondistance, overspeedstate = NEW.overspeedstate,
                    overspeedtime = NEW.overspeedtime, overspeedgeofenceid = NEW.overspeedgeofenceid,
                    motionstreak = NEW.motionstreak
                WHERE id = NEW.id;
            END
        ");

        // Create trigger for DELETE operation
        DB::connection('traccar')->unprepared("
            CREATE TRIGGER tracar_tc_devices_delete_trigger
            AFTER DELETE ON $tcDevicesTable
            FOR EACH ROW
            BEGIN
                DELETE FROM $devicesTable WHERE id = OLD.id;
            END
        ");

        // Create trigger for INSERT operation (vice versa)
        DB::unprepared("
            CREATE TRIGGER dayalog_devices_insert_trigger
            AFTER INSERT ON $devicesTable
            FOR EACH ROW
            BEGIN
                INSERT INTO $tcDevicesTable (id, name, uniqueid, lastupdate, positionid, groupid, attributes, phone, model, contact, category, disabled, status, geofenceids, expirationtime, motionstate, motiontime, motiondistance, overspeedstate, overspeedtime, overspeedgeofenceid, motionstreak)
                VALUES (NEW.id, NEW.name, NEW.uniqueid, NEW.lastupdate, NEW.positionid, NEW.groupid, NEW.attributes, NEW.phone, NEW.model, NEW.contact, NEW.category, NEW.disabled, NEW.status, NEW.geofenceids, NEW.expirationtime, NEW.motionstate, NEW.motiontime, NEW.motiondistance, NEW.overspeedstate, NEW.overspeedtime, NEW.overspeedgeofenceid, NEW.motionstreak);
            END
        ");

        // Create trigger for UPDATE operation (vice versa)
        DB::unprepared("
            CREATE TRIGGER dayalog_devices_update_trigger
            AFTER UPDATE ON $devicesTable
            FOR EACH ROW
            BEGIN
                UPDATE $tcDevicesTable
                SET name = NEW.name, uniqueid = NEW.uniqueid, lastupdate = NEW.lastupdate, positionid = NEW.positionid, groupid = NEW.groupid, attributes = NEW.attributes, phone = NEW.phone, model = NEW.model, contact = NEW.contact, category = NEW.category, disabled = NEW.disabled, status = NEW.status, geofenceids = NEW.geofenceids, expirationtime = NEW.expirationtime, motionstate = NEW.motionstate, motiontime = NEW.motiontime, motiondistance = NEW.motiondistance, overspeedstate = NEW.overspeedstate, overspeedtime = NEW.overspeedtime, overspeedgeofenceid = NEW.overspeedgeofenceid, motionstreak = NEW.motionstreak
                WHERE id = NEW.id;
            END
        ");

        // Create trigger for DELETE operation (vice versa)
        DB::unprepared("
            CREATE TRIGGER dayalog_devices_delete_trigger
            AFTER DELETE ON $devicesTable
            FOR EACH ROW
            BEGIN
                DELETE FROM $tcDevicesTable WHERE id = OLD.id;
            END
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop triggers
        DB::connection('traccar')->unprepared('DROP TRIGGER IF EXISTS tracar_tc_devices_insert_trigger');
        DB::connection('traccar')->unprepared('DROP TRIGGER IF EXISTS tracar_tc_devices_update_trigger');
        DB::connection('traccar')->unprepared('DROP TRIGGER IF EXISTS tracar_tc_devices_delete_trigger');
        DB::unprepared('DROP TRIGGER IF EXISTS dayalog_devices_insert_trigger');
        DB::unprepared('DROP TRIGGER IF EXISTS dayalog_devices_update_trigger');
        DB::unprepared('DROP TRIGGER IF EXISTS dayalog_devices_delete_trigger');

        // Drop tables
        Schema::dropIfExists('devices');
    }
};
