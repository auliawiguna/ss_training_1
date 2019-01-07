<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LinkStats extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('link_stats', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('link_id');
            $table->string('ip');
            $table->string('browser');
            $table->timestamp('time');
            $table->foreign('link_id')->references('id')->on('links');
        });          
        //
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
