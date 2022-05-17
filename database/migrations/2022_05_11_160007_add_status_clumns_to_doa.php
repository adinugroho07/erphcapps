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
        Schema::table('doa', function (Blueprint $table) {
            //terkait wf
            $table->string('assignment_code',250)->after('justification');;
            $table->integer('assignment_id',false)->after('justification');;
            $table->string('status',150)->after('justification');;
            $table->string('doacode',150)->unique()->after('justification');
            $table->boolean('isedit')->default(true)->after('justification');
            $table->string('attachment1', 2048)->nullable();
            $table->string('attachment2', 2048)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('doa', function (Blueprint $table) {
            $table->dropColumn('doacode');
        });
    }
};
