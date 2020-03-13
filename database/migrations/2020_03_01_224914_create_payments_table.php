<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->bigIncrements('id');

            $table->double('amount');

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('order_id');
            $table->dateTime('paid_on'); // pour determiner la date du paiement
            $table->text('payment_reference'); // le code de reference pour chaque paiment

            // $table->foreign('user_id')->references('id')->on('users');
            // $table->foreign('order_id')->references('id')->on('orders');

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
