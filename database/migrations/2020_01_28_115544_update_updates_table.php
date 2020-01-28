<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUpdatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ipt_updates', function (Blueprint $table) {
            $table->integer('employee_id')->unsigned()->after('tracking_date');
            $table->foreign('employee_id')->references('id')->on('acc_employees');
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
