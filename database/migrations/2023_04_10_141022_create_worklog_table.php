<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('worklog', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('user_id')->nullable();
            $table->string('email', 50);
            $table->foreign('email')->references('email')->on('users');
            $table->enum('issue_type', ['Bug', 'Bug_Customer', 'Change Request', 'Epic', 'Feedback', 'Improvement', 'Leakage', 'Q&A', 'Sub-task', 'Task', 'New Feature'])->nullable();
            $table->decimal('issue_estimate', 8, 4)->nullable();
            $table->decimal('hours', 8, 4)->nullable();
            $table->dateTime('work_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('worklog');
    }
};
