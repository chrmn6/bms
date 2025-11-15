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
        Schema::create('programs', function (Blueprint $table) {
            $table->id('program_id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->date('program_date')->nullable();
            $table->time('time')->nullable();
            $table->string('location')->nullable();
            $table->unsignedInteger('attendees_count')->default(0);
            $table->enum('status', ['Planned', 'Ongoing', 'Completed', 'Cancelled'])->default('Planned');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programs');
    }
};
