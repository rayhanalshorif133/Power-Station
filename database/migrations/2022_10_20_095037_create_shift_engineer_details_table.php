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
        Schema::create('shift_engineer_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shift_engineer_id')
                    ->constrained('shift_engineers')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');            
            $table->date('date');
            $table->integer('six_am_to_two_pm')->default(0);
            $table->integer('two_pm_to_ten_pm')->default(0);
            $table->integer('ten_pm_to_six_am')->default(0);
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
        Schema::dropIfExists('shift_engineer_details');
    }
};
