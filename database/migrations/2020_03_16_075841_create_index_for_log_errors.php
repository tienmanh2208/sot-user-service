<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndexForLogErrors extends Migration
{
    public $collectionName = 'log_errors';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mongodb')->table($this->collectionName, function (Blueprint $table) {
            $table->index('type', 'log_error_index_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mongodb')->table($this->collectionName, function (Blueprint $table) {
            $table->dropIndex('log_error_index_type');
        });
    }
}
