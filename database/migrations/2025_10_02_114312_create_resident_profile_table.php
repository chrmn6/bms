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
        Schema::create('residents_profile', function (Blueprint $table) {
            $table->id('resident_profile_id');
            $table->unsignedBigInteger('resident_id')->unique();
            $table->foreign('resident_id')->references('resident_id')->on('residents')->onDelete('cascade');
            $table->enum('civil_status', ['Single', 'In A Relationship', 'Married', 'Widowed', 'Divorced'])->nullable();
            $table->string('citizenship')->nullable();
            $table->string('occupation')->nullable();
            $table->string('education')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('residents_profile');
    }
};