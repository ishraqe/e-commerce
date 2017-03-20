<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->timestamps();
            $table->string('title');
            $table->integer('category_id');
            $table->integer('brand_id');
            $table->text('description');
            $table->integer('price')->defaut(0);
            $table->integer('rating')->default(0);
            $table->string('image');
            $table->integer('number_of_products');
            $table->integer('products_user_id');
            $table->integer('is_available')->default(true);
            $table->boolean('is_sold')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('products');
    }
}
