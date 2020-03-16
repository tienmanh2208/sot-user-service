<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsCollection extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'questions';
    public $connection = 'mongodb';

    /**
     * Run the migrations.
     * @table questions
     *
     * @return void
     */
    public function up()
    {
        Schema::connection($this->connection)->create($this->tableName, function (Blueprint $table) {
            $table->tinyInteger('visibility');
            $table->tinyInteger('status');
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
       Schema::connection($this->connection)->drop($this->tableName);
     }
}
