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
        Schema::create('schedule', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('class_id');
            $table->foreign('class_id')->references('id')->on('class')->onDelete('cascade')->onUpdate('cascade');
            
            $table->enum('day', ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'])->default('Monday');
            $table->timestamp('start');
            $table->timestamp('end');
            $table->string('subject');
            $table->enum('type', ['book', 'main'])->default('book');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedule');
    }
};
