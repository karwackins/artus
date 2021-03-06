<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date');
            $table->tinyInteger('user_id');
            $table->text('customer_name')->default(null);
            $table->text('customer_tel')->default(null);
            $table->text('customer_email')->default(null);
            $table->json('order')->default(null);;
            $table->dateTime('delivery');
            $table->double('total', 5, 2);
            $table->text('comments')->default(null);
            $table->boolean('status')->default(0);;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
