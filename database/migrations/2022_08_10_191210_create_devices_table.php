<?php

use App\Models\Device;
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
        Schema::create('devices', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->foreignId('added_by')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('category_id')->constrained('device_categories')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('area_id')->constrained('device_areas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('section_id')->constrained('device_sections')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('main_device_id')->constrained('device_main_devices')->onDelete('cascade')->onUpdate('cascade');
            $table->longtext('image');
            $table->string('tag_no')->unique();
            $table->foreignId('current_status_id')->constrained('device_statuses')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('devices');
    }
};
