<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class addIndexingToMc2pqTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('fmt_mc2pq_ans')) {
            Schema::table('fmt_mc2pq_ans', function (Blueprint $table) {
                $table->index('question_id');
                $table->index('active');
                $table->index('arrange');
                $table->index('media_id');
            });
        }
        if (Schema::hasTable('fmt_mc2pq_ques')) {
            Schema::table('fmt_mc2pq_ques', function (Blueprint $table) {
                $table->index('media1_id');
                $table->index('media2_id');
                $table->index('active');
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
        // Schema::dropIfExists('fmt_mc2pq_ans');
    }
}
