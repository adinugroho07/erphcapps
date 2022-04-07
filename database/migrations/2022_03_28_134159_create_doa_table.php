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
        Schema::create('doa', function (Blueprint $table) {
            $table->id();
            $table->text('justification')->nullable();
            $table->string('oridepartment',255);
            $table->string('oriposition');
            $table->string('alias',225);
            $table->integer('alias_id',false)->default(0);
            $table->string('alias_acting',225);
            $table->integer('alias_acting_id',false)->default(0);
            $table->date('start_date');
            $table->date('end_date');
            $table->string('created_by',225);
            $table->boolean('is_active');
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
        Schema::dropIfExists('doa');
    }
};
