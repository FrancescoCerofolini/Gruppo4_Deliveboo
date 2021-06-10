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
            $table->string('customer_address', 100);
            $table->string('customer_email', 50);
            $table->string('customer_phone', 20);
            $table->string('customer_name', 50);
            $table->string('code', 10)->unique();
            $table->string('status', 100)->default('Pending');
            $table->decimal('amount', 6,2); // 9999,99
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
        Schema::dropIfExists('orders');
    }
}
