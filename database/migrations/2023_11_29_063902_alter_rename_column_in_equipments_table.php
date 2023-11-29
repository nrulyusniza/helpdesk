<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterRenameColumnInEquipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // rename existing column
        Schema::table('equipments', function (Blueprint $table) {
            $table->string('asset_kewpa', 50)->after('site_id')->nullable();
            $table->string('asset_seriesno', 50)->after('asset_kewpa')->nullable();
            $table->dropColumn('asset_kewpa, 50');
            $table->dropColumn('asset_seriesno, 50');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('equipments', function (Blueprint $table) {
            //
        });
    }
}
