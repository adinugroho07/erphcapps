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
        Schema::create('organization', function (Blueprint $table) {
            $table->id();
            $table->string('org_code', 100);
            $table->string('org_name', 400);
            $table->string('org_type', 400);
            $table->string('position_title', 400);
            $table->string('position_code', 100);
            $table->integer('parent_org', false)->nullable();
            $table->string('parent_org_code', 100)->nullable();
            $table->boolean('ishead');
            $table->boolean('havechild');
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
        Schema::dropIfExists('organization');
    }
};
