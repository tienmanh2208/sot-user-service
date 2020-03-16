<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndexForAnswersCollection extends Migration
{
    public $collection = 'answers';
    public $connection = 'mongodb';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection($this->connection)->table($this->collection, function (Blueprint $table) {
            $table->index('users_id', 'answers_index_users_id');
            $table->index('questions_id', 'answers_index_questions_id');
            $table->index('accepted', 'answers_index_accepted');
            $table->index(['users_id', 'accepted'], 'answers_index_users_id_accepted');
            $table->index(['users_id', 'questions_id'], 'answers_index_users_id_questions_id');
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
            $table->dropIndex('answers_index_users_id');
            $table->dropIndex('answers_index_questions_id');
            $table->dropIndex('answers_index_accepted');
            $table->dropIndex('answers_index_users_id_accepted');
            $table->dropIndex('answers_index_users_id_questions_id');
        });
    }
}
