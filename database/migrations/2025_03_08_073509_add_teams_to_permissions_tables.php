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
        $teams = config('permission.teams');
        $tableNames = config('permission.table_names');
        $columnNames = config('permission.column_names');
        $pivotRole = $columnNames['role_pivot_key'] ?? 'role_id';
        $pivotPermission = $columnNames['permission_pivot_key'] ?? 'permission_id';

        if (empty($tableNames)) {
            throw new \Exception('Error: config/permission.php not loaded. Run [php artisan config:clear] and try again.');
        }
        if ($teams && empty($columnNames['team_foreign_key'] ?? null)) {
            throw new \Exception('Error: team_foreign_key on config/permission.php not loaded. Run [php artisan config:clear] and try again.');
        }


        Schema::table($tableNames['roles'], function (Blueprint $table) use ($teams, $columnNames) {
          
            $table->unsignedBigInteger($columnNames['team_foreign_key'])->nullable();
            
        });


        Schema::table($tableNames['model_has_permissions'], function (Blueprint $table) use ($tableNames, $columnNames, $pivotPermission, $teams) {
             
        
            $table->unsignedBigInteger($columnNames['team_foreign_key']);
            

        });


        Schema::table($tableNames['model_has_roles'], function (Blueprint $table) use ($tableNames, $columnNames, $pivotRole, $teams) {

            
            $table->unsignedBigInteger($columnNames['team_foreign_key']);
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $tableNames = config('permission.table_names');
        $columnNames = config('permission.column_names');

        Schema::table($tableNames['roles'], function (Blueprint $table) use ($columnNames) {
            $table->dropIndex($columnNames['team_foreign_key'] . '_index');
        });


        Schema::table($tableNames['model_has_permissions'], function (Blueprint $table) use ($tableNames, $columnNames) {
             
      
            $table->dropColumn($columnNames['team_foreign_key']);
            

        });


        Schema::table($tableNames['model_has_roles'], function (Blueprint $table) use ($tableNames, $columnNames) {
            $table->dropColumn($columnNames['team_foreign_key']);
        });

    }
};
