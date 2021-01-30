<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {//blogsのテーブルがなかったら作りますよ
        //Laravel公式の処理
        if(!Schema::hasTable('blogs')){

            Schema::create('blogs', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('title',100);//stringの100文字
                $table->text('content');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blogs');
    }
}
