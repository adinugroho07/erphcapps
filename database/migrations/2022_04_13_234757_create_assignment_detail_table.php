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
        Schema::create('assignment_detail', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assignment_id');
            $table->string('assignment_code',250);
            $table->text('assignment_description');
            $table->integer('sequence')->default(1);//urutan proses approval yang mana
            $table->string('status',100);//status yang di berikan ketika approval
            $table->string('assignmeto',250);//orang yang mendapatkan assignment
            $table->integer('assignmetoid',false);//id orang yang mendapatkan assignment
            $table->string('delegateto',250)->nullable();//orang yang di delegeasikan untuk mendapatkan assignment
            $table->integer('delegatetoid',false)->nullable();//id orang yang di delegeasikan untuk mendapatkan assignment
            $table->text('apprnote')->nullable();
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
        Schema::dropIfExists('assignment_detail');
    }
};
