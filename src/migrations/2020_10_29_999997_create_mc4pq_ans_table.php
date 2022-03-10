<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMc4pqAnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fmt_mc4pq_ans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('question_id')->index();
            $table->longText('answer')->nullable();
            $table->tinyInteger('active')->index()->default(1);
            $table->foreignId('media_id')->nullable();
            $table->tinyInteger('arrange')->index()->default(0);
            $table->string('eng_word')->nullable();
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
        Schema::dropIfExists('fmt_mc4pq_ans');
    }
}
