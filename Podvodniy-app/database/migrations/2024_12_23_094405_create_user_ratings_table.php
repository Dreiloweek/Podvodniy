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
        Schema::create('user_ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Связь с таблицей users
            $table->foreignId('water_id')->constrained('water_brands')->onDelete('cascade'); // Связь с таблицей water_brands
            $table->integer('price')->unsigned(); // Оценка за цену
            $table->integer('bitterness')->unsigned(); // Оценка за горечь
            $table->integer('sweetness')->unsigned(); // Оценка за сладость
            $table->integer('saltiness')->unsigned(); // Оценка за соленость
            $table->integer('metallic')->unsigned(); // Оценка за железный привкус
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_ratings');
    }
};
