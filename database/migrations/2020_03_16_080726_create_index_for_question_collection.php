<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndexForQuestionCollection extends Migration
{
    public $collection = 'questions';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mongodb')->table($this->collection, function (Blueprint $table) {
            $table->index('group_id', 'questions_index_group_id');
            $table->index('status', 'questions_index_status');
            $table->index('user_id', 'questions_index_user_id');
            $table->index(['user_id', '_id'], 'questions_index_user_id_id');
            $table->index(['user_id', 'status'], 'questions_index_user_id_status');
            $table->index(['user_id', 'field_id'], 'questions_index_user_id_field_id');
            $table->index(['user_id', 'value'], 'questions_index_user_id_value');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mongodb')->table($this->collection, function (Blueprint $table) {
            $table->dropIndex('questions_index_group_id');
            $table->dropIndex('questions_index_status');
            $table->dropIndex('questions_index_user_id');
            $table->dropIndex('questions_index_user_id_id');
            $table->dropIndex('questions_index_user_id_status');
            $table->dropIndex('questions_index_user_id_field_id');
            $table->dropIndex('questions_index_user_id_value');
        });
    }
}
