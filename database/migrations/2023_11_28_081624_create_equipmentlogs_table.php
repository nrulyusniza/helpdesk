<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquipmentlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipmentlogs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('equipment_id')->nullable()->index('equipment_id');
            $table->string('asset_newlocation', 40)->nullable();
            $table->dateTime('log_updatedat')->nullable();
            $table->unsignedInteger('equipmentstatus_id')->nullable()->index('equipmentstatus_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('equipmentlogs');
    }
}
