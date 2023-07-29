<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluationsTable extends Migration
{
    public function up()
    {
        Schema::create('evaluations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // 評価したユーザーのID
            $table->unsignedBigInteger('restaurant_id'); // 評価されたレストランのID
            $table->integer('rating'); // 評価の数値
            $table->text('comment')->nullable(); // コメント（任意）
            $table->timestamps();

            // 外部キー制約を設定
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('restaurant_id')->references('id')->on('restaurants')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('evaluations');
    }
}
