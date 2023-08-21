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
        Schema::create('goods_tools', function (Blueprint $table) {
            $table->id();
            $table->foreignId('added_by')->constrained('users');
            $table->foreignId('device_id')->constrained('devices')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('room_details_id')->constrained('room_details')->onDelete('cascade')->onUpdate('cascade');
            $table->longtext('image');
            $table->longText('description')->nullable();
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
        Schema::dropIfExists('goods_tools');
    }
};
