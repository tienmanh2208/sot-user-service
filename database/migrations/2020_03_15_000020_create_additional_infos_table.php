<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdditionalInfosTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'additional_infos';

    /**
     * Run the migrations.
     * @table additional_infos
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('user_id');
            $table->string('facebook_account', 200)->nullable();
            $table->string('instagram', 200)->nullable();
            $table->string('introduction')->nullable();
            $table->integer('total_upvotes')->default('0');
            $table->integer('total_downvotes')->default('0');
            $table->integer('total_comments')->default('0');
            $table->integer('total_answers')->default('0');
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
