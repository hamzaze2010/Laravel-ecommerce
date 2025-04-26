<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class DropOrdersAndOrderItemsTables extends Migration
{
    public function up()
    {
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('orders');
    }

    public function down()
    {
        // Optionally, you can recreate the tables in the down() method, 
        // but it's generally safer to leave this empty for destructive changes.
    }


};
