<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('category')->default('local');
            $table->string('code', 7)->unique();
            $table->string('name', 60);
            $table->string('address1', 50);
            $table->string('address2', 50)->nullable();
            $table->string('address3', 50)->nullable();
            $table->string('address4', 50)->nullable();
            $table->string('postal_code', 10)->nullable();
            $table->string('country_code', 2)->nullable();
            $table->string('terms', 3);
            $table->string('payment_method');
            $table->string('bank_code', 3);
            $table->string('contact', 30)->nullable();
            $table->string('phone', 25)->nullable();
            $table->string('fax', 25)->nullable();
            $table->string('other', 25)->nullable();
            $table->string('tin', 25);
            $table->string('vat_code', 6);
            $table->string('ewt_code', 6);
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
        Schema::dropIfExists('vendors');
    }
}
