<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'questions';

    /**
     * Run the migrations.
     * @table questions
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->tinyInteger('visibility')->comment('1 - anyone can see
2 - no one can see');
            $table->tinyInteger('status')->comment('2 - resolved
1 - open');
            $table->integer('upvotes');
            $table->integer('downvotes');
            $table->json('content');
            $table->string('title', 200);
            $table->integer('value');
            $table->integer('field_id');
            $table->integer('user_id');
            $table->integer('group_section_id')->nullable();
            $table->integer('group_id')->nullable();
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
