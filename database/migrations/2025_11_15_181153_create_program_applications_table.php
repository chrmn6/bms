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
        Schema::create('program_applications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('program_id');
            $table->foreign('program_id')->references('program_id')->on('programs')->onDelete('cascade');

            $table->unsignedBigInteger('resident_id');
            $table->foreign('resident_id')->references('resident_id')->on('residents')->onDelete('cascade');

            $table->string('proof_file');
            $table->enum('status', ['Pending', 'Approved', 'Rejected'])->default('Pending');

            $table->unique(['program_id', 'resident_id']);
            $table->text('note')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('program_applications');
    }
};
