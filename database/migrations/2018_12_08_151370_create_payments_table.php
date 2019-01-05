<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('package_name')->nullable();
            $table->integer('package_id')->nullable();
            $table->integer('premium_job')->nullable();
            $table->decimal('amount')->nullable();
            $table->string('payment_method')->nullable();
            $table->enum('status', ['initial','pending','success','failed','declined','dispute'])->default('initial')->nullable();
            $table->string('currency')->nullable();
            $table->string('token_id')->nullable();
            
            $table->string('card_last4')->nullable();
            $table->string('card_id')->nullable();
            $table->string('card_brand')->nullable();
            $table->string('card_country')->nullable();
            $table->string('card_exp_month')->nullable();
            $table->string('card_exp_year')->nullable();

            $table->string('client_ip')->nullable();
            $table->string('charge_id_or_token')->nullable();
            $table->string('payer_email')->nullable();
            $table->string('description')->nullable();
            $table->string('local_transaction_id')->nullable();
            //payment created column will be use by gateway
            $table->integer('payment_created')->nullable();

            //Bank Payment Options
            $table->string('bank_swift_code')->nullable();
            $table->string('account_number')->nullable();
            $table->string('branch_name')->nullable();
            $table->string('branch_address')->nullable();
            $table->string('account_name')->nullable();
            $table->string('iban')->nullable();

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
        Schema::dropIfExists('payments');
    }
}
