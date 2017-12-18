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
            $table->string('name');
            $table->string('description');
            $table->string('quantity');
            $table->string('previousPrice')->nullable();
            $table->string('price');
            $table->string('image1Url')->nullable();
            $table->string('image2Url')->nullable();

            $table->rememberToken();
            $table->timestamps();

            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');

            $table->integer('purchase_entity_id')->unsigned()->nullable();
            $table->foreign('purchase_entity_id')->references('id')->on('purchase_entries');

            $table->integer('type_id')->unsigned()->nullable();
            $table->foreign('type_id')->references('id')->on('types');



        });


        DB::table('stocks')->insert([
            'name' => 'product01',
            'description' => 'despt01',
            'quantity' => '01',
            'previousPrice' => '20',
            'price' => '15',
            'type_id' => '1',

        ]);

        DB::table('stocks')->insert([
            'name' => 'product02',
            'description' => 'despt02',
            'quantity' => '10',
            'previousPrice' => '200',
            'price' => '150',
            'type_id' => '2',
        ]);

        DB::table('stocks')->insert([
            'name' => 'product03',
            'description' => 'despt03',
            'quantity' => '0120',
            'previousPrice' => '204',
            'price' => '159',
            'type_id' => '3',
        ]);

        DB::table('stocks')->insert([
            'name' => 'product04',
            'description' => 'despt04',
            'quantity' => '141',
            'previousPrice' => '28',
            'price' => '14',
            'type_id' => '4',
        ]);

        DB::table('stocks')->insert([
            'name' => 'product05',
            'description' => 'despt05',
            'quantity' => '0145',
            'previousPrice' => '2045',
            'price' => '157',
            'type_id' => '5',
        ]);
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
