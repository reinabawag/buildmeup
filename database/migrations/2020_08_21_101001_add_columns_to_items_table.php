<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->string('pvc_weight')->nullable();
            $table->string('nylon_weight')->nullable();
            $table->string('pe_weight')->nullable();
            $table->string('xlpe_weight')->nullable();
            $table->string('semicon_weight')->nullable();
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
            $table->dropColumn(['pvc_weight', 'nylon_weight', 'pe_weight', 'xlpe_weight', 'semicon_weight']);
        });
    }
}
