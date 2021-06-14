<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_user', function (Blueprint $table) {
            
            $table->unsignedBigInteger("user_id");
            $table->foreign("user_id")->references("id")->on("users");

            $table->unsignedBigInteger("category_id");
            $table->foreign("category_id")->references("id")->on("categories");

            $table->primary(["user_id", "category_id"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('category_user', function (Blueprint $table) {
            $table->dropForeign('category_user_category_id_foreign');
            $table->dropForeign('category_user_user_id_foreign');
        });
        Schema::dropIfExists('category_user');
    }
}
