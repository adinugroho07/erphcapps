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
        Schema::table('timesheet_detail', function (Blueprint $table) {
            $table->dropColumn('starthours');
            $table->dropColumn('endhours');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('timesheet_detail', function (Blueprint $table) {
            $table->dropColumn('starthours');
            $table->dropColumn('endhours');
        });
    }
};
