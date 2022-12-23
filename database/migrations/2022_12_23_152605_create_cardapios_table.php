<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardapiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cardapio', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titulo');
            $table->longText('content')->nullable();
            $table->string('slug')->nullable();
            $table->string('tags')->nullable();
            $table->bigInteger('views')->default(0);
            $table->unsignedInteger('categoria');
            $table->integer('cat_pai')->nullable();
            $table->integer('status')->nullable();

            $table->timestamps();

            $table->foreign('categoria')->references('id')->on('cardapio_cat')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cardapio');
    }
}
