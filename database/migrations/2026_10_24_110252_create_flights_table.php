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
            $table->foreignId('from_airport_id')->constrained('airports')->onDelete('cascade');
            $table->foreignId('to_airport_id')->constrained('airports')->onDelete('cascade');
            $table->time('from_time');
            $table->time('to_time');
            $table->string('code')->unique();
            $table->string('airlines');
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
