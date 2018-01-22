<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('name');
            $table->string('country')->nullable();
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->string('address')->nullable();
            $table->string('contactNo')->nullable();
            $table->string('shipping_name')->nullable();
            $table->string('shipping_address')->nullable();
            $table->string('shipping_country')->nullable();

            $table->string('shippingLocal')->nullable();
            $table->string('shippingInternational')->nullable();

            $table->string('reputation')->nullable();

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
