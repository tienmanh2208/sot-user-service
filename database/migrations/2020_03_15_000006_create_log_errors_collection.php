<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateLogErrorsCollection extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'log_errors';

    /**
     * Run the migrations.
     * @table log_errors
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mongodb')->create($this->tableName, function ($collection) {
            $collection->string('type', 45)->nullable();
            $collection->string('function', 45)->nullable();
            $collection->string('error_description', 45)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::connection('mongodb')->drop([$this->tableName]);
    }
}
