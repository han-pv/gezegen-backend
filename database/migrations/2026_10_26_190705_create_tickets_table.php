<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('flight_id')->constrained('flights')->onDelete('cascade');
            $table->foreignId('passenger_id')->constrained('passengers')->onDelete('cascade');
            $table->string('seat_number')->nullable();
            $table->integer('passenger_count')->default(1);
            $table->decimal('total_price', 8, 2);
            $table->string('status')->default('booked');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
