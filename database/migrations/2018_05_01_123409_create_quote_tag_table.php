<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuoteTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quote_tag', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->integer('tag_id')->unsigned();
            $table->integer('quote_id')->unsigned();  

            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
            $table->foreign('quote_id')->references('id')->on('quotes')->onDelete('cascade');             
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quote_tag');
    }
}
