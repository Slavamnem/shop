<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCityWarehouseColumnsToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn("phone");
            $table->dropForeign("orders_user_id_foreign");
            $table->dropColumn("user_id");
            $table->dropColumn("email");
            $table->string("city")->after("delivery_type_id");
            $table->text("warehouse")->nullable()->after("city");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn("city");
            $table->dropColumn("warehouse");
            $table->integer("user_id")->after("sum");
            $table->string("phone");
            $table->string("email");
        });
    }
}
