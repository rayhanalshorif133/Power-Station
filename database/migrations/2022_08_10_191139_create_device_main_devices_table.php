<?php

use App\Models\DeviceMainDevice;
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
        Schema::create('device_main_devices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('added_by')
                ->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('name')->unique();
            $table->timestamps();
        });

        DeviceMainDevice::create([
            'added_by' => 1,
            'name' => 'Main Device 1',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('device_main_devices');
    }
};
