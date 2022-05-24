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
        Schema::table('mutasi', function (Blueprint $table) {
            $table->string('username',200)->after('poscode');
            $table->string('userid',200)->after('poscode');

            $table->string('username_destination',200)->after('poscode_destination');
            $table->string('userid_destination',200)->after('poscode_destination');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mutasi', function (Blueprint $table) {
            //
        });
    }
};
