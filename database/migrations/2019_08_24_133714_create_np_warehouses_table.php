<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNpWarehousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('np_warehouses', function (Blueprint $table) {
            $table->increments('id');
            $table->string("name");
            $table->string("ref")->unique();
            $table->string("address");
            $table->string("city_ref");
            $table->foreign('city_ref')->references('ref')->on('cities');
            $table->integer("number");
            $table->string("phone")->nullable();
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
        Schema::dropIfExists('np_warehouses');
    }
}
