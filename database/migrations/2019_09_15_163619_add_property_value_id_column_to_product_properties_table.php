<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPropertyValueIdColumnToProductPropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_properties', function (Blueprint $table) {
            $table->dropColumn('value');
            $table->integer("property_value_id")->unsigned()->after('product_id');
            $table->foreign('property_value_id')->references('id')->on('property_values');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_properties', function (Blueprint $table) {
            $table->dropForeign("product_properties_property_value_id_foreign");
            $table->dropColumn('property_value_id');
            $table->text('value')->after('id');
        });
    }
}
