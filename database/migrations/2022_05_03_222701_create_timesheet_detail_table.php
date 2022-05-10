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
        Schema::create('timesheet_detail', function (Blueprint $table) {
            $table->id();
            $table->foreignId('timesheet_id');
            $table->boolean('workstatus')->default(false);
            $table->date('tanggal');
            $table->time('starthours', $precision = 0);
            $table->time('endhours', $precision = 0);
            $table->integer('totalhours');
            $table->boolean('hadir')->default(false);
            $table->string('worklocation', 250)->nullable();
            $table->string('remarks', 400)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('timesheet_detail');
    }
};
