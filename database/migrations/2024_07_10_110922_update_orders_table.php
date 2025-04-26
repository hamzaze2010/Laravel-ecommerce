<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('first_name')->after('user_id');
            $table->string('last_name')->after('first_name');
            $table->string('country')->after('last_name');
            $table->string('address')->after('country');
            $table->string('city')->after('address');
            $table->string('state')->after('city');
            $table->string('postcode')->after('state');
            $table->string('phone')->after('postcode');
            $table->string('email')->after('phone');
            $table->decimal('subtotal', 10, 2)->after('email');
            $table->decimal('total', 10, 2)->change();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['first_name', 'last_name', 'country', 'address', 'city', 'state', 'postcode', 'phone', 'email', 'subtotal', 'status']);
            $table->decimal('total', 8, 2)->change();
            $table->string('status')->after('user_id');
        });
    }
}
