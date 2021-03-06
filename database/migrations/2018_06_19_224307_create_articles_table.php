<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->comment('文章标题');
            $table->integer('articlecat_id')->unsigned()->default('0')->comment('文章分类');
            $table->foreign('articlecat_id')
                ->references('id')
                ->on('article_cats')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('image')->nullable()->comment('文章封面');
            $table->string('video')->nullable()->comment('文章视频');
            $table->mediumText('description')->nullable()->comment('文章描述');
            $table->mediumText('tags')->nullable()->comment('文章TAGS');
            $table->text('content')->nullable()->comment('文章详情');
            $table->integer('user_id')->default('0')->comment('用户ID');
            $table->tinyInteger('status')->default('0')->comment('状态');
            $table->tinyInteger('recom')->default('0')->comment('推荐');
            $table->integer('sort')->default('0')->comment('排序');
            $table->integer('view_count')->default('0')->comment('浏览量');
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
        Schema::dropIfExists('articles');
    }
}
