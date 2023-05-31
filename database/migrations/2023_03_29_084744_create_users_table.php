<?php

use App\Models\Department;
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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->integer('code')->nullable();
            $table->string('fullname', 50)->nullable();
            $table->string('email', 50)->unique();
            $table->string('area_code', 6)->nullable();
            $table->string('phone_number', 16)->nullable();
            $table->date('day_of_birth')->nullable();
            $table->string('address', 100)->nullable();
            $table->enum('roles', ['Other', 'Admin', 'DM', 'Sub-DM', 'TL', 'PM', 'Members'])->nullable();
            $table->enum('levels', ['Other', 'Level 1', 'Level 2', 'Level 3', 'Level 4', 'Level 5'])->nullable();
            $table->enum('status', ['Inactive', 'Active', 'Left'])->nullable();
            $table->enum('types', ['Other', 'Official', 'Probationary', 'Apprenticeship', 'Fresher', 'Intern', 'Onsite'])->nullable();
            $table->string('password')->nullable();
            $table->rememberToken();
            $table->string('note')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreignId('department_id')
                  ->nullable()
                  ->constrained('departments')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
