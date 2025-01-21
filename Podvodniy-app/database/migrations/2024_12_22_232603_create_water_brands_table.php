<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('water_brands', function (Blueprint $table) {
            $table->id();
            $table->string('water_name'); // Название марки воды
            $table->decimal('price', 8, 2); // Цена
            $table->string('calcium'); // Кальций
            $table->string('magnesium'); // Магний
            $table->string('sodium_potassium'); // Натрий и Калий
            $table->string('sulfates'); // Сульфаты
            $table->string('chlorides'); // Хлориды
            $table->string('bicarbonates'); // Гидрокарбонаты
            $table->string('nitrates'); // Нитраты
            $table->string('fluorides'); // Фториды
            $table->string('silicon_dioxide'); // Диоксид кремния
            $table->string('ph'); // Кислотность
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('water_brands');
    }
};
