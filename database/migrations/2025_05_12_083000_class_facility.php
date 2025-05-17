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
        Schema::create('class_facility', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('class_id');
            $table->foreign('class_id')->references('id')->on('class')->onDelete('cascade')->onUpdate('cascade');
            
            $table->string('name');
            $table->enum('condition', ['good', 'fair', 'broken'])->default('good');
            $table->integer('total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_facility');
    }
};
