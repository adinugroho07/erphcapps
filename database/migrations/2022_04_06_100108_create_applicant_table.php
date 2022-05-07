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
        Schema::create('applicant', function (Blueprint $table) {
            $table->id();
            //data workflow
            $table->string('status',150);
            $table->boolean('isedit')->default(true);
            //data pribadi
            $table->string('name',150);
            $table->string('email')->unique();
            $table->string('gender',150);
            $table->date('birthdate');
            $table->text('address');
            $table->string('districts',250);//kecamatan
            $table->string('city',250);//kota
            $table->string('postalcode',150);
            $table->string('placeborn',150);
            $table->string('citizenship',250);
            $table->string('religion',150);
            $table->string('phonenumber',150);
            $table->string('married',150);
            $table->string('degree',100);
            $table->string('NIK',100);
            $table->string('NPWP',100);
            $table->string('bloodtype',100);
            //data pendidikan
            $table->string('lastdegree',250);//pendidikan terakhir
            $table->string('major',250);//jurusan
            $table->string('studyprogram',250);//program studi
            $table->date('startschool');//tahun masuk kuliah
            $table->date('endschool');//tahun keluar kuliah
            $table->string('positionexporg',250)->nullable();//posisi ketika di org tsb
            $table->string('orgname',250)->nullable();//nama org nya
            $table->text('orgdescriptions')->nullable();//menjelaskan ketika di dalam org tsb ngapain aja
            $table->date('inorg')->nullable();
            $table->date('outorg')->nullable();
            //lampiran
            $table->string('ijazah', 2048)->nullable();
            $table->string('cv', 2048)->nullable();
            //approval and note
            $table->string('interviewer',250);
            $table->integer('idintvw',false);
            $table->string('appr1',250);
            $table->integer('idappr1',false);
            $table->string('appr2',250);
            $table->integer('idappr2',false);
            $table->text('interviewnote')->nullable();
            $table->text('apprlvl1note')->nullable();
            $table->text('apprlvl2note')->nullable();
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
        Schema::dropIfExists('applicant');
    }
};
