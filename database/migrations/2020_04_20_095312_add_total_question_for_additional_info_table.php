<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTotalQuestionForAdditionalInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('additional_infos', function (Blueprint $table) {
            $table->bigInteger('total_questions')->after('total_answers')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('additional_infos', function (Blueprint $table) {
            $table->dropColumn('total_questions');
        });
    }
}
