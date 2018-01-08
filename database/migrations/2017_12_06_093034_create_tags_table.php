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
            $table->string('tag_name');

            $table->rememberToken();
            $table->timestamps();

        });

        DB::table('tags')->insert([
            'tag_name' => 'stamps'
        ]);
        DB::table('tags')->insert([
            'tag_name' => 'Sheets'
        ]);
        DB::table('tags')->insert([
            'tag_name' => 'Covers'
        ]);
        DB::table('tags')->insert([
            'tag_name' => 'Sri Lanka'
        ]);
        DB::table('tags')->insert([
            'tag_name' => 'Used'
        ]);
        DB::table('tags')->insert([
            'tag_name' => 'Not Used'
        ]);
        DB::table('tags')->insert([
            'tag_name' => 'Others'
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
