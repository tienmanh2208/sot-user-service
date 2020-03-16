<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndexForTagsCollection extends Migration
{
    public $connection = 'mongodb';
    public $collection = 'tags';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection($this->connection)->table($this->collection, function (Blueprint $table) {
            $table->index('questions_id', 'tags_index_question_id');
            $table->index('content', 'tags_index_content');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection($this->connection)->table($this->collection, function (Blueprint $table) {
            $table->dropIndex('tags_index_question_id');
            $table->dropIndex('tags_index_content');
        });
    }
}
