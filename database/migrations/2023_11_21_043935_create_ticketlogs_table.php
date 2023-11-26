<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticketlogs', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('date')->nullable();
            $table->text('description')->nullable();
            $table->unsignedInteger('ticket_id')->nullable()->index('ticket_id');
            $table->string('update_by', 10)->nullable();
            $table->date('response_date')->nullable();
            $table->time('response_time')->nullable();
            $table->unsignedInteger('reaction_id')->nullable()->index('reaction_id');
            $table->string('attachment', 40)->nullable();
            $table->unsignedInteger('log_status')->nullable()->index('log_status');

            $table->index(['id'], 'ticket');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ticketlogs');
    }
}
