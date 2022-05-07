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
        Schema::create('wfprocess', function (Blueprint $table) {
            $table->id();
            $table->integer('sequencenow');//urutan proses approval yang mana
            $table->integer('sequencenext');//urutan proses approval yang selanjutnya
            $table->string('status',100);//status sekarang
            $table->integer('ownertrxid');//id doc yang sedang melakukan approval
            $table->integer('assignment_id');
            $table->string('assignment_code',250);
            $table->boolean('isprocessactive');//apakah process ini aktive
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
        Schema::dropIfExists('wfprocess');
    }
};
