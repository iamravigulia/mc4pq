<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMc4pqQuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fmt_mc4pq_ques', function (Blueprint $table) {
            $table->id();
            $table->longText('question')->nullable();
            $table->foreignId('media1_id')->index()->nullable();
            $table->foreignId('media2_id')->index()->nullable();
            $table->foreignId('media3_id')->index()->nullable();
            $table->foreignId('media4_id')->index()->nullable();
            $table->tinyInteger('active')->index()->default(1);
            $table->string('hint')->nullable();
            $table->foreignId('difficulty_level_id')->nullable()->comment = 'id from difficulty_levels table';
            $table->string('format_title')->nullable();
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
        Schema::dropIfExists('fmt_mc4pq_ques');
    }
}
