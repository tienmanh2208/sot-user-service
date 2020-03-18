<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoryAssignTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'history_assign';

    /**
     * Run the migrations.
     * @table history_assign
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('report_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('assign_to');
            $table->text('reason')->nullable();
            $table->timestamps();

            $table->index(["user_id"], 'fk_history_assign_users1_idx');

            $table->index(["assign_to"], 'fk_history_assign_users2_idx');

            $table->index(["report_id"], 'fk_history_assign_reports1_idx');


            $table->foreign('report_id', 'fk_history_assign_reports1_idx')
                ->references('id')->on('reports')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('user_id', 'fk_history_assign_users1_idx')
                ->references('id')->on('users')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('assign_to', 'fk_history_assign_users2_idx')
                ->references('id')->on('users')
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
