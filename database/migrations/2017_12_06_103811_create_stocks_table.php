<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('productName');
            $table->string('description');
            $table->string('quantity');
            $table->string('previousPrice')->nullable();
            $table->string('price');
            $table->string('image1Url')->nullable();
            $table->string('image2Url')->nullable();

            $table->string('rating')->nullable();

            $table->rememberToken();
            $table->timestamps();

            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');

            $table->integer('purchase_entity_id')->unsigned()->nullable();
            $table->foreign('purchase_entity_id')->references('id')->on('purchase_entries');

            $table->integer('type_id')->unsigned()->nullable();
            $table->foreign('type_id')->references('id')->on('types');

            $table->integer('favorite_id')->unsigned()->nullable();
            $table->foreign('favorite_id')->references('id')->on('types');
        });

//
//        DB::table('stocks')->insert([
//            'productName' => 'product01',
//            'description' => 'despt01',
//            'quantity' => '01',
//            'previousPrice' => '20',
//            'price' => '15',
//            'type_id' => '1',
//
//        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stocks');
    }
}
