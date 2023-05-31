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
        Schema::create('project', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->enum('types', ['Other', 'Fixed Price', 'Body Shopping']);
            $table->enum('status', ['Other', 'Coming', 'On-going', 'Closed', 'Pending']);
            $table->dateTime('begin_date');
            $table->dateTime('finish_date');
            $table->string('customer_name', 100);
            $table->string('note')->nullable();
            $table->double('mm', 8, 3);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project');
    }
};
