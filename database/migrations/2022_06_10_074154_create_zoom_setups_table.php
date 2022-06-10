<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zoom_setups', function (Blueprint $table) {
            $table->id();
            $table->string('api_key');
            $table->string('callback_url');
            $table->dateTimeTz('last_refresh_time');
            $table->dateTimeTz('last_refresh_message');
            $table->dateTimeTz('environment');
            $table->dateTimeTz('refresh_time');
            $table->dateTimeTz('retry_after');
            $table->dateTimeTz('retry_times');
            $table->dateTimeTz('last_meeting');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('zoom_setups');
    }
};
