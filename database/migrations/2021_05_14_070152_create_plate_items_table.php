<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plate_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plate_id')->constrained('plates');
            $table->foreignId('product_id')->constrained('products');
            $table->double('ilosc', 5, 2);
            $table->integer('wybor')->default(0);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plate_items');
    }
}
