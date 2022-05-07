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
            $table->string('department',225)->after('assignment_code');
            $table->string('department_code',100)->after('assignment_code');
            $table->string('posname',225)->after('assignment_code');
            $table->string('poscode',100)->after('assignment_code');
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
            $table->dropColumn('department');
            $table->dropColumn('department_code');
            $table->dropColumn('posname');
            $table->dropColumn('poscode');
        });
    }
};
