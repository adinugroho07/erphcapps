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
        Schema::table('wfassignment', function (Blueprint $table) {
            $table->string('link',250)->after('modulename');
            $table->string('codetransaction',250)->after('modulename');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('wfassignment', function (Blueprint $table) {
            $table->dropColumn('link');
            $table->dropColumn('codetransaction');
        });
    }
};
