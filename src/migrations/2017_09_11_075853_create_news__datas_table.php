<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsDatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('news__datas')) {
            Schema::create('news__datas', function (Blueprint $table) {
                $table->increments('id');
                $table->string('lang');
                $table->string('title');
                $table->text('text');
                $table->timestamps();
                $table->softDeletes();
                $table->integer('news_id')->index();
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
        Schema::dropIfExists('news__datas');
    }
}
