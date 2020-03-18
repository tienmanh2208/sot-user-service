<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupSectionsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'group_sections';

    /**
     * Run the migrations.
     * @table group_sections
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('group_infos_id');
            $table->text('name');
            $table->text('Description');
            $table->timestamps();

            $table->index(["group_infos_id"], 'fk_group_sections_group_infos1_idx');


            $table->foreign('group_infos_id', 'fk_group_sections_group_infos1_idx')
                ->references('id')->on('group_infos')
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
