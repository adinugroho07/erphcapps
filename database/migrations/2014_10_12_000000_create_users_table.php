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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name',150);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('suppervisor',225)->nullable();
            $table->string('suppervisor_posname',225)->nullable();
            $table->integer('suppervisor_id',false)->nullable();
            $table->string('department',225);
            $table->string('department_code',100);
            $table->string('posname',225);
            $table->string('poscode',100);
            $table->string('status', 100)->default('active');
            $table->timestamp('expiredcontractdate')->nullable();
            $table->string('posstatus',100);
            $table->string('sex',50)->nullable();
            $table->timestamp('birthdate')->nullable();
            $table->string('religion',100)->nullable();
            $table->string('spouse',200)->nullable();
            $table->string('child1',200)->nullable();
            $table->string('child2',200)->nullable();
            $table->string('child3',200)->nullable();
            $table->boolean('married')->default(false);
            $table->string('state',225)->nullable();
            $table->string('city',225)->nullable();
            $table->string('phonenum',100)->nullable();
            $table->string('bankkey',100)->nullable();
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
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
        Schema::dropIfExists('users');
    }
};
