<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswersTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'answers';

    /**
     * Run the migrations.
     * @table answers
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('users_id');
            $table->integer('questions_id');
            $table->json('content')->nullable();
            $table->json('replies')->nullable();
            $table->tinyInteger('accepted')->nullable()->comment('0 - not accepted
1 - accepted
2 - waiting');
            $table->tinyInteger('viewed')->nullable()->comment('1 - YES
0 - NO');
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
