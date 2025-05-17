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
        Schema::create('history', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

            $table->enum('activity', ['booking class', 'complaint'])->default('booking class');

            $table->unsignedBigInteger('book_id')->nullable();
            $table->foreign('book_id')->references('id')->on('booking_class')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('complaint_id')->nullable();
            $table->foreign('complaint_id')->references('id')->on('complaint')->onDelete('cascade')->onUpdate('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('history');
    }
};
