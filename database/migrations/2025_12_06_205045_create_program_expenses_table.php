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
        Schema::create('program_expenses', function (Blueprint $table) {
            $table->id('expense_id');
            $table->unsignedBigInteger('program_id');
            $table->foreign('program_id')->references('program_id')->on('programs')->onDelete('cascade');
            $table->decimal('amount', 12, 2);

            // Who created the expense (official)
            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreign('created_by')->references('official_id')->on('officials')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('program_expenses');
    }
};
