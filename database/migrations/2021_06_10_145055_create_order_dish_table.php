<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDishTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_dish', function (Blueprint $table) {
            $table->unsignedBigInteger("order_id");
            $table->foreign("order_id")->references("id")->on("orders");

            $table->unsignedBigInteger("dish_id");
            $table->foreign("dish_id")->references("id")->on("dishes");

            $table->primary(["order_id", "dish_id"]);

            $table->tinyInteger('quantity');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_dish', function (Blueprint $table) {
            $table->dropForeign('order_dish_id_foreign');
            $table->dropColumn('order_id');
            $table->dropColumn('dish_id');
            $table->dropColumn('quantity');
            
        });
        Schema::dropIfExists('order_dish');
    }
}
