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
            'type' => 'Stamp'
        ]);
        DB::table('types')->insert([
            'type' => 'Miniature Sheet'
        ]);
        DB::table('types')->insert([
            'type' => 'First Day Cover'
        ]);
        DB::table('types')->insert([
            'type' => 'Special Cover'
        ]);
        DB::table('types')->insert([
            'type' => 'Other'
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
