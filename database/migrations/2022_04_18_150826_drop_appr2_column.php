<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('applicant', function (Blueprint $table) {

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('applicant', function (Blueprint $table) {
            $table->dropColumn('interviewer');
            $table->dropColumn('idintvw');
            $table->dropColumn('appr1');
            $table->dropColumn('idappr1');
            $table->dropColumn('appr2');
            $table->dropColumn('idappr2');
            $table->dropColumn('interviewnote');
            $table->dropColumn('apprlvl1note');
            $table->dropColumn('apprlvl2note');
        });

    }
};
