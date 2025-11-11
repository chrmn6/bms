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
        Schema::create('officials', function (Blueprint $table) {
            $table->id('official_id');
            $table->string('full_name');
            $table->enum('position', ['Barangay Captain', 'SK Kagawad', 'Barangay Council']);
            $table->date('term_start');
            $table->date('term_end')->nullable();
            $table->enum('status', ['Active', 'Inactive']);
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('officials');
    }
};
