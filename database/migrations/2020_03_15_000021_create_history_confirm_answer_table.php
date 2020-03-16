<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoryConfirmAnswerTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'history_confirm_answer';

    /**
     * Run the migrations.
     * @table history_confirm_answer
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('answers_questions_id');
            $table->integer('previous_status');
            $table->integer('current_status');
            $table->unsignedInteger('users_id');
            $table->unsignedInteger('answers_users_id');
            $table->timestamps();

            $table->index(["answers_users_id"], 'fk_history_confirm_answer_users2_idx');

            $table->index(["users_id"], 'fk_history_confirm_answer_users1_idx');


            $table->foreign('users_id', 'fk_history_confirm_answer_users1_idx')
                ->references('id')->on('users')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('answers_users_id', 'fk_history_confirm_answer_users2_idx')
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
