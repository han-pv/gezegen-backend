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
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->string('airline');
            $table->string('flight_number');
            $table->foreignId('origin_airport_id')->constrained('airports')->onDelete('cascade');
            $table->foreignId('destination_airport_id')->constrained('airports')->onDelete('cascade');
            $table->dateTime('departure_time');
            $table->dateTime('arrival_time');
            $table->string('duration')->nullable();
            $table->decimal('price', 8, 2);
            $table->integer('empty_seats')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flights');
    }
};
