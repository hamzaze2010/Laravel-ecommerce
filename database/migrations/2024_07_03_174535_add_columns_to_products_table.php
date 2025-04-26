<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->integer('quantity')->default(0)->after('price');
            $table->decimal('disc_price', 8, 2)->nullable()->after('quantity');
            $table->boolean('hot_trend')->default(0)->after('disc_price');
            $table->boolean('best_seller')->default(0)->after('hot_trend');
            $table->boolean('featured')->default(0)->after('best_seller');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('quantity');
            $table->dropColumn('disc_price');
            $table->dropColumn('hot_trend');
            $table->dropColumn('best_seller');
            $table->dropColumn('featured');
        });
    }
}
