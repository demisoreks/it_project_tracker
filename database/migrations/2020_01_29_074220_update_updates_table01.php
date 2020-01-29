<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUpdatesTable01 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ipt_updates', function (Blueprint $table) {
            $table->dropForeign(['project_id']);
            $table->foreign('project_id')->references('id')->on('ipt_projects');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ipt_updates', function (Blueprint $table) {
            //
        });
    }
}
