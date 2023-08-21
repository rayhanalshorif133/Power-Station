<?php

use App\Models\DeviceCategory;
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
        Schema::create('device_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('added_by')
                ->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('name')->unique();
            $table->timestamps();
        });

        DeviceCategory::create([
            'added_by' => 1,
            'name' => 'Category 1',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('device_categories');
    }
};
