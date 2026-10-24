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
        Schema::create('hotels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('city_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('address')->nullable();
            $table->unsignedInteger('capacity')->default(1);
            $table->unsignedTinyInteger('stars')->nullable();
            $table->string('phone')->nullable();
            $table->string('image')->nullable();
            $table->decimal('rating', 3, 2)->nullable();
            $table->boolean('active')->default(true);
            $table->string('email')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotels');
    }
};
