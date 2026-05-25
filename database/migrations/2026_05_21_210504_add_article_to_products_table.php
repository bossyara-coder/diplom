<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // 1. Сначала просто добавляем колонку (БЕЗ unique)
        Schema::table('products', function (Blueprint $table) {
            $table->string('article', 6)->nullable()->after('id');
        });

        // 2. Гарантированно заполняем все старые товары уникальными артикулами
        // Берем 100000 и прибавляем ID товара, чтобы точно избежать дубликатов
        $products = DB::table('products')->get();
        foreach ($products as $product) {
            DB::table('products')
                ->where('id', $product->id)
                ->update(['article' => (string)(100000 + $product->id)]);
        }

        // 3. Теперь, когда пустых строк нет, безопасно вешаем уникальность
        Schema::table('products', function (Blueprint $table) {
            $table->unique('article');
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('article');
        });
    }
};