<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddReferencesKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->integer("category_id")->unsigned()->change();
            $table->integer("group_id")->unsigned()->change();
            $table->integer("status_id")->unsigned()->change();
            $table->integer("color_id")->unsigned()->change();
            $table->integer("size_id")->unsigned()->change();
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('group_id')->references('id')->on("model_groups");
            $table->foreign('status_id')->references('id')->on('product_statuses');
            $table->foreign('color_id')->references('id')->on('colors');
            $table->foreign('size_id')->references('id')->on('sizes');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->integer("user_id")->unsigned()->change();
            $table->integer("client_id")->unsigned()->change();
            $table->integer("payment_type_id")->unsigned()->change();
            $table->integer("delivery_type_id")->unsigned()->change();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('client_id')->references('id')->on('clients');
            $table->foreign('payment_type_id')->references('id')->on('payment_types');
            $table->foreign('delivery_type_id')->references('id')->on("delivery_types");
        });

        Schema::table('admin_auth', function (Blueprint $table) {
            $table->integer("user_id")->unsigned()->change();
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::table('order_products', function (Blueprint $table) {
            $table->integer("order_id")->unsigned()->change();
            $table->integer("product_id")->unsigned()->change();
            $table->foreign('order_id')->references('id')->on('orders');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign("category_id");
            $table->dropForeign("group_id");
            $table->dropForeign("status_id");
            $table->dropForeign("color_id");
            $table->dropForeign("size_id");
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign("user_id");
            $table->dropForeign("client_id");
            $table->dropForeign("payment_type_id");
            $table->dropForeign("delivery_type_id");
        });

        Schema::table('admin_auth', function (Blueprint $table) {
            $table->dropForeign("user_id");
        });

        Schema::table('order_products', function (Blueprint $table) {
            $table->dropForeign("order_id");
            $table->dropForeign("product_id");
        });
    }
}
