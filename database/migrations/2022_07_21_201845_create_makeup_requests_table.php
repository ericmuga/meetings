<?php

use App\Models\Member;
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
        Schema::create('makeup_requests', function (Blueprint $table) {
            $table->id();
            $table->date('makeup_date');
            $table->foreignIdFor(Member::class);
            $table->string('description');
            $table->text('details');
            $table->string('category');
            $table->string('approver')->nullable();
            $table->date('approval_date')->nullable();
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
        Schema::dropIfExists('makeup_requests');
    }
};
