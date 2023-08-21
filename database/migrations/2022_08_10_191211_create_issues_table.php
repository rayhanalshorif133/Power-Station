<?php

use App\Models\Issue;
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
        Schema::create('issues', function (Blueprint $table) {
            $table->id();
            $table->foreignId('added_by')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('department_id');
            $table->unsignedBigInteger('from_forwarded_department_id')->nullable();
            $table->unsignedBigInteger('forwarded_department_id')->nullable();
            $table->string('collaboration_department')->nullable();
            $table->integer('issue_id');
            $table->string('title')->unique();
            $table->string('image');
            $table->text('description')->nullable();
            $table->enum('seriousness', ['normal', 'emergency', 'super_emergency'])->default('normal');
            $table->text('recommendation');
            // Status
            $table->enum('status', ['pending', 'checked', 'accepted', 'approved', 'solved', 'canceled','close'])->default('pending');
            $table->enum('forwarded_status', ['pending', 'accepted', 'rejected'])->nullable();
            $table->enum('collaboration_status', ['pending', 'accepted', 'rejected'])->nullable();
            $table->enum('work_permit_status', ['pending', 'accepted', 'rejected'])->nullable();
            // Just Note
            $table->string('note')->nullable();
            $table->unsignedBigInteger('note_edit_by')->nullable();
            $table->timestamps();
        });


        // Create Issue
        Issue::create([
            'added_by' => 1,
            'department_id' => '1',
            'issue_id' => 1,
            'title' => 'Issue 1',
            'image' => 'storage/IssueImage/issue_image30_08_22_11_08_51.png',
            'description' => 'This is just a dummy description',
            'seriousness' => 'normal',
            'recommendation' => 'This is just a dummy recommendation',
            'status' => 'pending',
        ]);
        Issue::create([
            'added_by' => 1,
            'department_id' => '2',
            'issue_id' => 1,
            'title' => 'Issue 2',
            'image' => 'storage/IssueImage/issue_image30_08_22_11_08_51.png',
            'description' => 'This is just a dummy description',
            'seriousness' => 'super_emergency',
            'recommendation' => 'This is just a dummy recommendation',
            'status' => 'pending',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('issues');
    }
};
