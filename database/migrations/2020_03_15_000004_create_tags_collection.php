<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagsCollection extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $collectionName = 'tags';
    public $connection = 'mongodb';

    /**
     * Run the migrations.
     * @table tags
     *
     * @return void
     */
    public function up()
    {
        Schema::connection($this->connection)->create($this->collectionName, function (Blueprint $table) {
            $table->integer('questions_id');
            $table->string('content', 45)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::connection($this->connection)->drop($this->collectionName);
     }
}
