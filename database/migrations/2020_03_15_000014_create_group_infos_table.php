<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupInfosTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'group_infos';

    /**
     * Run the migrations.
     * @table group_infos
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('creator');
            $table->text('title');
            $table->integer('default_coin');
            $table->tinyInteger('privacy')->default('1')->comment('1 - public
2 - protected
3 - private');
            $table->string('key', 45)->nullable()->comment('Contain key to access group');

            $table->index(["creator"], 'fk_group_infos_users1_idx');


            $table->foreign('creator', 'fk_group_infos_users1_idx')
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
