<?php

use App\Models\DeviceArea;
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
        Schema::create('device_areas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('added_by')
                ->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('name')->unique();
            $table->timestamps();
        });

        DeviceArea::create([
            'added_by' => 1,
            'name' => 'Area 1',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('device_areas');
    }
};
