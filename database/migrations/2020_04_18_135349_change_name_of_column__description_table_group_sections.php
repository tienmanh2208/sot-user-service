<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeNameOfColumnDescriptionTableGroupSections extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('group_sections', function (Blueprint $table) {
            $table->renameColumn('Description', 'description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('group_sections', function (Blueprint $table) {
            $table->renameColumn('description', 'Description');
        });
    }
}
