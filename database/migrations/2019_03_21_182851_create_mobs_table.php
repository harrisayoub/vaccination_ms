<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mobs', function (Blueprint $table) {
            $table->increments('mob_id');
            $table->integer('user_id')->unsigned();
            $table->string('mob_breed', 50);
            $table->integer('no_animals');
            $table->string('tag_color', 20);
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
        Schema::dropIfExists('mobs');
    }
}
