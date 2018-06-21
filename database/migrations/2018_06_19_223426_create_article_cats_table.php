<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleCatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_cats', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('文章分类');
            $table->integer('sort')->default('0')->comment('文章分类排序');
            $table->tinyInteger('status')->default('1')->comment('是否显示');
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
        Schema::dropIfExists('article_cats');
    }
}
