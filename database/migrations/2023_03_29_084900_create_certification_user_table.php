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
        Schema::create('certification_user', function (Blueprint $table) {
            $table->unsignedBigInteger('certification_id');
            $table->unsignedBigInteger('user_id');
            $table->unique(['certification_id', 'user_id']);


            $table->foreign('certification_id')->references('id')->on('certifications')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certification_user');
    }
};
