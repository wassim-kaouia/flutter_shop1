<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->boolean('email_verified')->default(false);
            $table->string('mobile')->nullable(); // nullable parceque y a pas de sense pour forcer l'utilisateur de saisir son numero de telephone de debut            
            $table->boolean('mobile_verified')->default(false);
            $table->string('password');
 
            $table->unsignedBigInteger('shipping_address')->nullable();
            $table->unsignedBigInteger('billing_address')->nullable();

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
