<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 10)->unique()->comment('分类名称');
            $table->mediumText('description')->nullable()->comment('分类描述');
            $table->unsignedTinyInteger('sort')->default(1)->index()->comment('权重');
            $table->unsignedTinyInteger('is_show')->default(1)->index()->comment('是否显示在前台');
            $table->string('image', 255)->default('')->comment('分类logo');
            $table->text('content')->nullable()->comment('产品简介');
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
        Schema::dropIfExists('categories');
    }
}
