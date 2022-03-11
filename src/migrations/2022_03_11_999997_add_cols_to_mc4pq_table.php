<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class addColsToMc4pqTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('fmt_mc4pq_ques')) {
            Schema::table('fmt_mc4pq_ques', function (Blueprint $table) {
                $table->string('media_title1')->before('media1_id')->nullable();
                $table->string('media_title2')->before('media2_id')->nullable();
                $table->string('media_title3')->before('media3_id')->nullable();
                $table->string('media_title4')->before('media4_id')->nullable();
            });
        }
        // if (Schema::hasTable('fmt_mc2pq_ques')) {
        //     Schema::table('fmt_mc2pq_ques', function (Blueprint $table) {
        //         $table->index('media1_id');
        //         $table->index('media2_id');
        //         $table->index('active');
        //     });
        // }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('fmt_mc2pq_ans');
    }
}
