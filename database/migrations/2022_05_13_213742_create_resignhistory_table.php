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
        Schema::create('resignhistory', function (Blueprint $table) {
            $table->id();
            $table->integer('ownertrxid');//id doc yang sedang melakukan approval
            $table->string('status',100);//status yang di berikan ketika approval
            $table->string('changeby',100);
            $table->text('memo');
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
        Schema::dropIfExists('resignhistory');
    }
};
