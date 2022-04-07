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
        Schema::create('jobposting', function (Blueprint $table) {
            $table->id();
            $table->text('jobdescription');
            $table->text('jobqualification');
            $table->string('applicantcode',100);
            $table->string('jobtype',100);
            $table->string('joblocation',100);
            $table->string('department',225);
            $table->string('department_code',100);
            $table->string('posname',225);
            $table->string('poscode',100);
            $table->string('degreequalification',100);
            $table->integer('yearexperinece', false);
            $table->text('benefit');
            $table->timestamp('jobpostingdate');
            $table->date('start_date');
            $table->date('end_date');
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
        Schema::dropIfExists('jobposting');
    }
};
