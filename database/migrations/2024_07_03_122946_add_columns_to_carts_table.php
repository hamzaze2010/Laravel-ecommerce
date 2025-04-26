<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('carts', function (Blueprint $table) {
            // Add 'user_id' column
            $table->unsignedBigInteger('user_id')->nullable()->after('id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // Add 'product_id' column
            $table->unsignedBigInteger('product_id')->after('user_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');

            // Add 'quantity' column
            $table->integer('quantity')->default(1)->after('product_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('carts', function (Blueprint $table) {
            // Drop foreign key constraints first (if needed)
            $table->dropForeign(['user_id']);
            $table->dropForeign(['product_id']);

            // Drop columns
            $table->dropColumn('user_id');
            $table->dropColumn('product_id');
            $table->dropColumn('quantity');
        });
    }
}
