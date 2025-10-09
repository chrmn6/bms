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
        Schema::create('clearances', function (Blueprint $table) {
            $table->id('clearance_id');
            $table->unsignedBigInteger('resident_id');
            $table->foreign('resident_id')->references('resident_id')->on('residents')->onDelete('cascade');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->string('clearance_type');
            $table->text('purpose');
            $table->date('issued_date')->nullable();
            $table->date('valid_until')->nullable();
            $table->enum('status', ['Pending', 'Approved', 'Rejected', 'Released']);
            $table->string('or_number')->nullable();
            $table->decimal('amount_paid', 10, 2)->nullable();
            $table->enum('payment_status', ['Unpaid', 'Paid'])->default('Unpaid');
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clearances');
    }
};
