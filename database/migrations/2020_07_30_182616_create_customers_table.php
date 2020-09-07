<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 7)->nullable();
            $table->string('name', 60);
            $table->string('addr1', 50)->nullable();
            $table->string('addr2', 50)->nullable();
            $table->string('addr3', 50)->nullable();
            $table->string('addr4', 50)->nullable();
            $table->string('city', 30)->nullable();
            $table->string('zip', 10)->nullable();
            $table->string('region')->nullable();
            $table->string('industry')->nullable();
            $table->string('slsman');
            $table->string('terms')->nullable();
            $table->integer('overdue_days')->nullable();
            $table->double('overdue_amt')->nullable();
            $table->integer('terms_days')->nullable();
            $table->string('order_contact', 30)->nullable();
            $table->string('contact_phone', 25)->nullable();
            $table->string('fax', 25)->nullable();
            $table->string('billing_contact', 30)->nullable();
            $table->string('billing_phone', 25)->nullable();
            $table->string('vat_code', 6);
            $table->string('ewt_code', 6);
            $table->string('tin_code', 25);
            $table->text('remarks')->nullable();
            $table->integer('user_id')->unsigned();
            $table->string('status')->default('pending');

            $table->boolean('treasury_is_approved')->default(false);
            $table->boolean('treasury_user_id')->nullable();
            $table->dateTime('treasury_approved_at')->nullable();

            $table->boolean('credit_is_approved')->default(false);
            $table->boolean('credit_user_id')->nullable();
            $table->dateTime('credit_approved_at')->nullable();

            $table->softDeletes();
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
        Schema::dropIfExists('customers');
    }
}
