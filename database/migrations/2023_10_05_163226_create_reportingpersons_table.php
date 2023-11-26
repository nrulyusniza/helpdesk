<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportingpersonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reportingpersons', function (Blueprint $table) {
            $table->increments('id');
            $table->string('rptpers_name', 40);
            $table->string('rptpers_phone', 40);
            $table->string('rptpers_ext', 40);
            $table->string('rptpers_mobile', 40)->nullable();
            $table->string('rptpers_email', 40)->nullable();
            $table->unsignedInteger('site_id')->nullable()->index('site_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reportingpersons');
    }
}
