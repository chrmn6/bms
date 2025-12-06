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
        Schema::create('blotter_cases', function (Blueprint $table) {
            $table->id('blotter_case_id');
            $table->unsignedBigInteger('blotter_id');
            $table->foreign('blotter_id')->references('blotter_id')->on('blotters')->onDelete('cascade');
            $table->string('incident_type');
            $table->date('incident_date');
            $table->time('incident_time');
            $table->string('location');
            $table->text('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blotter_cases');
    }
};
