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
        Schema::table('users', function (Blueprint $table) {
            $table->string('address', 300)->nullable()->after('city');
            $table->string('backtoback', 300)->nullable()->after('posstatus');
            $table->integer('backtoback_id', false)->nullable()->after('posstatus');
            $table->string('postalcode', 100)->nullable()->after('state');
            $table->string('bank', 100)->nullable()->after('bankkey');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('address');
            $table->dropColumn('bank');
            $table->dropColumn('postalcode');
            $table->dropColumn('backtoback');
        });
    }
};
