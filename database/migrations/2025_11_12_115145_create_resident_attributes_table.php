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
        Schema::create('resident_attributes', function (Blueprint $table) {
            $table->id('resident_attribute_id');
            $table->unsignedBigInteger('resident_id')->unique();
            $table->foreign('resident_id')->references('resident_id')->on('residents')->onDelete('cascade');

            $table->enum('voter_status', ['Yes', 'No'])->default('No');
            $table->string('blood_type', 3)->nullable();
            $table->boolean('is_approved')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resident_attributes');
    }
};
