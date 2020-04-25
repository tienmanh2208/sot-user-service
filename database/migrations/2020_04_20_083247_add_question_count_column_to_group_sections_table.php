<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddQuestionCountColumnToGroupSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('group_sections', function (Blueprint $table) {
            $table->bigInteger('question_count')->after('group_infos_id')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('group_sections', function (Blueprint $table) {
            $table->dropColumn('question_count');
        });
    }
}
