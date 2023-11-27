<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('categories_id');
            $table->string('name');
            $table->text('description');
            $table->text('more_description');
            $table->string('avatar');
            $table->string('img1');
            $table->string('img2');
            $table->string('img3');
            $table->double('original_price', 10,2);
            $table->float('promotion_price', 10,2);
            $table->float('quantity');
            $table->timestamps();

            $table->foreign('categories_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
