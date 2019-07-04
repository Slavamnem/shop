<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBasketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('baskets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("client_id")->unsigned()->nullable();
            $table->foreign("client_id")->references("id")->on("clients");
            $table->integer("city_id")->unsigned()->nullable();
            $table->foreign("city_id")->references("id")->on("cities");
            $table->double("weight")->default(0)->nullable();
            $table->string("status")->default("Активна");
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
        Schema::dropIfExists('baskets');
    }
}
