<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->integer("status_id");
            $table->double("sum");
            $table->integer("user_id")->nullable();
            $table->integer("client_id")->nullable();
            $table->text("description")->nullable();
            $table->integer("phone")->nullable();
            $table->integer("email")->nullable();
            $table->integer("payment_type_id")->nullable();
            $table->integer("delivery_type_id")->nullable();
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
