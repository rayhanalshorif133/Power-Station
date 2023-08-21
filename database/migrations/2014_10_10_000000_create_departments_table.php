<?php

use App\Models\Department;
use App\Models\User;
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
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('added_by');
            $table->string('name')->unique();
            $table->string('has_users')->nullable();
            $table->timestamps();
        });


        // Insert default data
        Department::create([
            'added_by' => 1,
            'name' => 'Dept 1',
            'has_users' => '2,1'
        ]);

        Department::create([
            'added_by' => 1,
            'name' => 'Dept 2',
            'has_users' => '1,2,3'
        ]);

        Department::create([
            'added_by' => 1,
            'name' => 'Dept 3',
            'has_users' => '1,2,3,4'
        ]);

        Department::create([
            'added_by' => 1,
            'name' => 'Dept 4',
            'has_users' => '1,2,4,5'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('departments');
    }
};
