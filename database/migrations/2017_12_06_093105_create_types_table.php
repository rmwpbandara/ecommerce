<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');

            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('types')->insert([
            'type' => 'type 01'
        ]);
        DB::table('types')->insert([
            'type' => 'type 02'
        ]);
        DB::table('types')->insert([
            'type' => 'type 03'
        ]);
        DB::table('types')->insert([
            'type' => 'type 04'
        ]);
        DB::table('types')->insert([
            'type' => 'type 05'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('types');
    }
}
