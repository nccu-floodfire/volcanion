<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePttSummariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ptt_summaries', function (Blueprint $table) {
            $table->bigIncrements('id');
	    $table->datetime('date')->comment('文章發表時間');
       	    $table->string('category')->comment('PTT的版別');
            $table->unsignedInteger('count_num')->default(0)->comment('收集到的篇數');
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
        Schema::dropIfExists('ptt_summaries');
    }
}
