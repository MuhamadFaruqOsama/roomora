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
        Schema::create('complaint', function (Blueprint $table) {
            $table->id();
            
            // user id
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

            // class id
            $table->unsignedBigInteger('class_id');
            $table->foreign('class_id')->references('id')->on('class')->onDelete('cascade')->onUpdate('cascade');
            
            $table->string('title');
            $table->text('photo');
            $table->text('desc')->nullable();
            $table->enum('status', ['pending', 'rejected', 'finished', 'confirmed'])->default('pending');
            $table->text('response')->nullable();
            $table->timestamp('response_created_at');
            $table->boolean('confirmed')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaint');
    }
};
