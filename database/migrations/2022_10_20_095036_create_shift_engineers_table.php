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
        Schema::create('shift_engineers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('added_by')
                    ->constrained('users');
            $table->string('shift_name');
            $table->string('year_month');
            $table->string('assign_users_id')->nullable();
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
        Schema::dropIfExists('shift_engineers');
    }
};
