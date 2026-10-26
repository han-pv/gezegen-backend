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
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->foreignId('from_city_id')->constrained('cities')->cascadeOnDelete();
            $table->foreignId('to_city_id')->constrained('cities')->cascadeOnDelete();
            $table->string('airline');
            $table->string('flight_number');
            $table->dateTime('departure_at');
            $table->dateTime('arrival_at');
            $table->decimal('price', 10, 2);
            $table->unsignedSmallInteger('total_seats');
            $table->unsignedSmallInteger('available_seats');
            $table->boolean('active')->default(true);
            $table->timestamps();
    
            $table->index(['from_city_id', 'to_city_id', 'departure_at']);
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
