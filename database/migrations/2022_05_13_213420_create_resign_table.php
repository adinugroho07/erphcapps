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
        Schema::create('resign', function (Blueprint $table) {
            $table->id();
            //terkait wf
            $table->string('assignment_code',250);
            $table->integer('assignment_id',false);
            $table->string('status',150);
            $table->string('resigncode',150)->unique();
            $table->boolean('isedit')->default(true);

            $table->string('department',225);
            $table->string('department_code',100);
            $table->string('posname',225);
            $table->string('poscode',100);
            $table->string('name',250);
            $table->string('email',250);
            $table->text('description');
            $table->string('nik',200);
            $table->date('startwork');
            $table->date('endwork');
            $table->string('created_by',250);
            $table->integer('created_byid',false);
            //attachment
            $table->string('attachment1', 2048)->nullable();
            $table->string('attachment2', 2048)->nullable();
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
        Schema::dropIfExists('resign');
    }
};
