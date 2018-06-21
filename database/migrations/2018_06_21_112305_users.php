<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Users extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('open_id')->unique()->comment('openid');
            $table->string('nickname')->comment('用户昵称');
            $table->string('avatar')->comment('用户头像');
            $table->string('city')->comment('城市');
            $table->string('province')->comment('省份');
            $table->string('mobile')->nullable()->comment('手机');
            $table->integer('score')->default(0)->comment('积分');
            $table->integer('fid')->default(0)->comment('推荐人ID');
            $table->integer('dlid')->default(0)->comment('上级代理商ID');
            $table->integer('status')->default(0)->comment('是否认证');
            $table->integer('p1')->default(0)->comment('p1');
            $table->integer('p2')->default(0)->comment('p2');
            $table->rememberToken();
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
        //
    }
}
