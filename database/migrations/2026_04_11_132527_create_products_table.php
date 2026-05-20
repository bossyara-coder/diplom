<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');         // Название (например, "Скейтборд Trailblaze")
            $table->decimal('price', 10, 2); // Цена (например, 5000.00)
            $table->string('image');        // Имя файла картинки (например, "skate1.png")
            $table->string('category');     // Категория для твоего JS-фильтра (например, "skateboards")
            $table->text('description')->nullable(); // Описание (на будущее)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
