<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewColumnsToItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->boolean('stocked')->nullable()->after('issue_unit');
            $table->boolean('lot_tracked')->nullable()->after('stocked');
            $table->boolean('reservable')->nullable()->after('lot_tracked');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->dropColumn(['stocked', 'lot_tracked', 'reservable']);
        });
    }
}
