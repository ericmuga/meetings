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
        Schema::create('grading_rules', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->float('min_minutes');
            $table->integer('min_members');
            $table->time('start_time');
            // $table->enum('meeting_type',['physical','makeup','guest_makeup']);
            $table->string('meeting_type');
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
        Schema::dropIfExists('grading_rules');
    }
};
