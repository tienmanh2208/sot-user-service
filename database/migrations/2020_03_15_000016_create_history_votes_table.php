<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoryVotesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'history_votes';

    /**
     * Run the migrations.
     * @table history_votes
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('users_id');
            $table->tinyInteger('action')->comment('1 up
-1 down');
            $table->integer('post_id');
            $table->tinyInteger('type')->comment('1- comment
2 - question');

            $table->index(["users_id"], 'fk_votes_users1_idx');


            $table->foreign('users_id', 'fk_votes_users1_idx')
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
