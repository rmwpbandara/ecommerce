<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');

            $table->rememberToken();
            $table->timestamps();

        });

        DB::table('tags')->insert([
            'name' => 'tag 01'
        ]);
        DB::table('tags')->insert([
            'name' => 'tag 02'
        ]);
        DB::table('tags')->insert([
            'name' => 'tag 03'
        ]);
        DB::table('tags')->insert([
            'name' => 'tag 04'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tags');
    }
}
