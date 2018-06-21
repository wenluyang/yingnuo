<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50)->comment('商品名称');
            $table->string('rebate', 50)->comment('返现比率');
            $table->string('video', 50)->comment('视频');
            $table->decimal('price', 8, 2)->index()->comment('商品价格');
            $table->text('description')->nullable()->comment('商品描述');
            $table->text('content')->nullable()->comment('商品详情');
            $table->unsignedTinyInteger('sort')->default(1)->index()->comment('权重,数字越小越靠前');
            $table->unsignedTinyInteger('is_sale')->default(1)->index()->comment('是否上架');
            $table->unsignedInteger('buy_count')->default(0)->index()->comment('出售数量');
            $table->unsignedInteger('stock')->default(9999)->index()->comment('库存数量');
            $table->string('image')->comment('商品图片');
            $table->integer('category_id')->unsigned()->default('0')->comment('商品所属分类id');
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade')
                ->onUpdate('cascade');
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
        Schema::dropIfExists('goods');
    }
}
