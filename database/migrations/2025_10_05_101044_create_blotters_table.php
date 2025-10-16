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
        Schema::create('blotters', function (Blueprint $table) {
            $table->id('blotter_id');
            $table->unsignedBigInteger('resident_id');
            $table->foreign('resident_id')->references('resident_id')->on('residents')->onDelete('cascade');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->string('incident_type');
            $table->date('incident_date');
            $table->time('incident_time');
            $table->string('location');
            $table->text('description');
            $table->enum('status', ['pending', 'processing', 'approved', 'rejected'])->default('pending');
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blotters');
    }
};
