<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTwitterSummariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('twitter_summaries', function (Blueprint $table) {
            $table->bigIncrements('id');
	    $table->datetime('date')->comment('文章發表時間');
            $table->string('bin_name')->comment('twitter收集的名稱');
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
        Schema::dropIfExists('twitter_summaries');
    }
}
