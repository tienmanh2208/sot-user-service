<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserGroupsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'user_groups';

    /**
     * Run the migrations.
     * @table user_groups
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('group_infos_id');
            $table->integer('users_id');
            $table->tinyInteger('role')->comment('1 - member
2 - content management');
            $table->tinyInteger('permission')->comment('1 - only view
2 - can post question, can not reply
3 - can reply, can not create question
4 - can do anything');

            $table->index(["users_id"], 'fk_user_groups_users1_idx');


            $table->foreign('users_id', 'fk_user_groups_users1_idx')
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
