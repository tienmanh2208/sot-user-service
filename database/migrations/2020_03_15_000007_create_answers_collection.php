<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswersCollection extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'answers';
    public $connection = 'mongodb';

    /**
     * Run the migrations.
     * @table answers
     *
     * @return void
     */
    public function up()
    {
        Schema::connection($this->connection)->create($this->tableName, function (Blueprint $table) {
            $table->integer('users_id');
            $table->string('questions_id');
            $table->json('content')->nullable();
            $table->json('replies')->nullable();
            $table->tinyInteger('accepted')->nullable();
            $table->tinyInteger('viewed')->nullable();
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
