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
        Schema::create('timesheet', function (Blueprint $table) {
            $table->id();
            //terkait wf
            $table->string('assignment_code',250);
            $table->integer('assignment_id',false);
            $table->string('status',150);
            $table->string('timesheetcode',150)->unique();
            $table->boolean('isedit')->default(true);

            //data pekerja nya
            $table->string('name',250);
            $table->string('email',250);
            $table->text('description');
            $table->integer('periode');

            //Attachment
            $table->string('attachment1', 2048)->nullable();
            $table->string('attachment2', 2048)->nullable();
            $table->string('attachment3', 2048)->nullable();
            $table->string('attachment4', 2048)->nullable();

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
        Schema::dropIfExists('timesheet');
    }
};
