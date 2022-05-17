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
        Schema::create('roleheader', function (Blueprint $table) {
            $table->id();
            $table->string('rolecode',250)->unique();
            $table->string('rolename', 250);
            $table->text('description');
            $table->string('created_by',250);
            $table->integer('created_byid',false);
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
        Schema::dropIfExists('roleheader');
    }
};
