<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('item');
            $table->string('description');
            $table->string('type');
            $table->string('source');
            $table->string('cost_type');
            $table->string('cost_method');
            $table->string('abc_code');
            $table->string('product_code');
            $table->string('unit_measure');
            $table->string('unit_weight');
            $table->string('purchase_unit');
            $table->string('stock_unit');
            $table->string('issue_unit');
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
        Schema::dropIfExists('items');
    }
}
