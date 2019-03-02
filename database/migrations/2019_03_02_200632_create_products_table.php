<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug')->unique();
            $table->double("base_price");
            $table->integer("quantity");
            $table->integer("category_id");
            $table->text("description")->nullable();
            $table->string("image");
            $table->string("small_image")->nullable();
            $table->integer("group_id");
            $table->integer("status_id");
            $table->integer("color_id");
            $table->integer("size_id");
            $table->softDeletes();
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
        Schema::dropIfExists('products');
    }
}
