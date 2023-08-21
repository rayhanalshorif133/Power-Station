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
        Schema::create('goods_tools_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('goods_tools_id')
                    ->constrained('goods_tools')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->longText('message');
            $table->dateTime('date_time')->default(date("Y-m-d H:i:s"));
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
        Schema::dropIfExists('goods_tools_logs');
    }
};
