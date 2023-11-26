<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIssuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issues', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('request_no', 25);
            $table->integer('request_type')->nullable()->default(1);
            $table->integer('site_id')->index('site_id');
            $table->string('reported_by', 100);
            $table->string('phone_no', 20);
            $table->integer('reqcategory_id')->index('reqcategory_id');
            $table->integer('equipment_id')->index('equipment_id');
            $table->text('attachment');
            $table->text('fault_description');
            $table->string('created_by', 20)->nullable();
            $table->dateTime('create_date')->nullable();
            $table->integer('status_id')->nullable()->index('status_id');
            $table->text('admin_comments')->nullable();
            $table->integer('severity_id')->default(3)->index('severity_id');
            $table->string('updated_by', 20)->nullable();
            $table->dateTime('update_date')->nullable();

            $table->unique(['id', 'request_no'], 'idx_request_no');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('issues');
    }
}
