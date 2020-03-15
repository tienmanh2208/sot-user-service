<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'users';

    /**
     * Run the migrations.
     * @table users
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('username', 200);
            $table->string('password');
            $table->string('first_name', 100);
            $table->date('date_of_birth');
            $table->string('last_name', 100);
            $table->string('mail', 100);
            $table->tinyInteger('role')->default('1')->comment('1 - user
2 - admin
3 - ');
            $table->tinyInteger('account_status')->default('1')->comment('1 - active
0 - banned');
            $table->string('coin_remain', 45)->default('0');

            $table->unique(["password"], 'password_UNIQUE');

            $table->unique(["username"], 'username_UNIQUE');
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
