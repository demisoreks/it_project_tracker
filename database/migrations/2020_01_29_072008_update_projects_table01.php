<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateProjectsTable01 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ipt_projects', function (Blueprint $table) {
            $table->dropForeign(['vendor_id']);
            $table->foreign('vendor_id')->references('id')->on('ipt_vendors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ipt_projects', function (Blueprint $table) {
            //
        });
    }
}
