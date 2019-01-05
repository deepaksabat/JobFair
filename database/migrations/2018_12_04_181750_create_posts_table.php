<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable();
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->longText('post_content')->nullable();
            $table->string('feature_image')->nullable();
            $table->enum('type', ['post', 'page'])->default('post')->nullable();
            $table->enum('status', [0,1,2])->default(0)->nullable();
            $table->tinyInteger('show_in_header_menu')->nullable();
            $table->tinyInteger('show_in_footer_menu')->nullable();
            $table->integer('views')->default(0)->nullable();
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
        Schema::dropIfExists('posts');
    }
}
