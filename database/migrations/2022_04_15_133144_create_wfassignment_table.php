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
        Schema::create('wfassignment', function (Blueprint $table) {
            $table->id();
            $table->string('assignment_code',250);
            $table->text('description');
            $table->integer('sequence');//urutan proses approval yang mana
            $table->string('assignstatus',100);
            $table->string('modulename',100);//nama proses nya di ambil dari module yang sedang ber transaksi
            $table->string('origperson',250);//original person
            $table->integer('origpersonid',false);
            $table->string('assignperson',250)->nullable();//yang dapet assignment
            $table->integer('assignpersonid',false)->nullable();//ID yang dapet assignment
            $table->integer('ownertrxid');//id doc yang sedang melakukan approval
            $table->integer('processid',false);//ID wfprocess

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
        Schema::dropIfExists('wfassignment');
    }
};
