<?php

// use App\Models\ZoomUser;
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
        Schema::create('zoom_meetings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('meeting_no');
            $table->string('uuid')->nullable();
            $table->string('title')->nullable();
            $table->boolean('gradable');
            // $table->foreignIdFor(ZoomUser::class);
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
        Schema::dropIfExists('zoom_meetings');
    }
};
