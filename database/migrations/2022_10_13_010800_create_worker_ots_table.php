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
        Schema::create('worker_ots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('added_by')->constrained('users');
            $table->foreignId('user_id')->constrained('users');
            $table->string('start_date_time');
            $table->string('end_date_time');
            $table->string('purpose');
            $table->string('status')->default('pending');
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
        Schema::dropIfExists('worker_ots');
    }
};
