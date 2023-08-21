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
        Schema::create('issue_has_devices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('issues_id')->constrained('issues')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('devices_id')->constrained('devices')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('needed_status_id')->constrained('device_statuses')->onDelete('cascade')->onUpdate('cascade');
            $table->string('note')->nullable();
            $table->enum('work_permit_status', ['waiting', 'pending', 'approved', 'rejected'])->default('waiting');
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
        Schema::dropIfExists('issue_has_devices');
    }
};
