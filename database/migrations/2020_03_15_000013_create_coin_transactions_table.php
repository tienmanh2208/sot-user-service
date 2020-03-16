<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoinTransactionsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'coin_transactions';

    /**
     * Run the migrations.
     * @table coin_transactions
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('users_id');
            $table->integer('amount');
            $table->tinyInteger('action')->comment('1 - spending to ask question
2 - charge
3 - reclaim coin from quetion
4 - earn coin from answer question');

            $table->index(["users_id"], 'fk_coin_transactions_users1_idx');


            $table->foreign('users_id', 'fk_coin_transactions_users1_idx')
                ->references('id')->on('users')
                ->onDelete('no action')
                ->onUpdate('no action');
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
