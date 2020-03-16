<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndexForCommentsCollection extends Migration
{
    public $connection = 'mongodb';
    public $collection = 'comments';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection($this->connection)->table($this->collection, function (Blueprint $table) {
            $table->index('questions_id', 'comments_index_questions_id');
            $table->index('users_id', 'comments_index_users_id');
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
            $table->dropIndex('comments_index_questions_id');
            $table->dropIndex('comments_index_users_id');
        });
    }
}
