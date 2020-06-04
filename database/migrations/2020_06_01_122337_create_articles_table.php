<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->bigIncrements('id');
            $table->bigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->string('title');
            $table->string('author')->nullable();
            $table->string('publisher')->nullable();
            $table->date('publication_date')->nullable();
            $table->integer('price')->nullable();
            $table->double('rating', 1, 1);
            $table->longText('caption')->nullable();
            $table->longText('body');
            $table->string('upfile')->nullable(); //画像・動画投稿しない場合に備えてNULL許可しておく
            $table->tinyInteger('status')->default(1)->comment('0=下書き, 1=アクティブ, 2=削除済み');
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
