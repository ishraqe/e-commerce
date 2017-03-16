<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id');
            $table->integer('product_user_id');
            $table->integer('product_comment_id');
            $table->integer('product_comment_user_id');

            $table->integer('blog_id');
            $table->integer('blog_user_id');
            $table->integer('blog_comment_id');
            $table->integer('blog_comment_user_id');
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
        Schema::drop('notifications');
    }
}
