<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductPropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_properties', function (Blueprint $table) {
            $table->increments('id');
            $table->text('value');
            $table->integer("property_id")->unsigned();
            $table->foreign("property_id")->references("id")->on("properties");
            $table->integer("product_id")->unsigned();
            $table->foreign("product_id")->references("id")->on("products");
            $table->integer("ordering")->nullable()->default(100);
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
        Schema::dropIfExists('product_properties');
    }
}
