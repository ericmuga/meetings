<?php

use App\Models\Club;
use App\Models\GradingRule;
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
        Schema::create('meetings', function (Blueprint $table) {
            $table->id();
            $table->enum('type',['physical','makeup','guest_makeup','zoom'])->index();
            $table->dateTimeTz('date');
            $table->string('venue');
            $table->string('topic')->index();
            $table->text('host');
            $table->text('uuid')->nullable();
            $table->unsignedBigInteger('meeting_no')->index()->nullable();
            $table->foreignIdFor(GradingRule::class);
            $table->foreignIdFor(Club::class);
            $table->text('official_start_time');
            $table->text('official_end_time');
            $table->text('detail');
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
        Schema::dropIfExists('meetings');
    }
};
