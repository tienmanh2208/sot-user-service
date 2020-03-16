<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'reports';

    /**
     * Run the migrations.
     * @table reports
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('id_content', 45)->comment('id của nội dung bị report
Có thể là comment, bài post, ...');
            $table->tinyInteger('report_type')->comment('1 - comment
2 - post
3 - answer');
            $table->string('reason', 45);
            $table->tinyInteger('status')->default('1')->comment('0 - open
1 - in progress
2 - done
3 - cancel');
            $table->integer('user_report');
            $table->integer('user_resolve');
            $table->integer('report_info_id');

            $table->index(["user_resolve"], 'fk_reports_users2_idx');

            $table->index(["user_report"], 'fk_reports_users1_idx');

            $table->index(["report_info_id"], 'fk_reports_report_info1_idx');


            $table->foreign('user_report', 'fk_reports_users1_idx')
                ->references('id')->on('users')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('user_resolve', 'fk_reports_users2_idx')
                ->references('id')->on('users')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('report_info_id', 'fk_reports_report_info1_idx')
                ->references('id')->on('report_info')
                ->onDelete('no action')
                ->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists($this->tableName);
     }
}
