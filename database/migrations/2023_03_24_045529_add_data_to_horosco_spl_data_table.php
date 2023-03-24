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
        Schema::table('horosco_spl_data', function (Blueprint $table) {
            $table->integer('data')->nullable()->after('spl_date_to');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('horosco_spl_data', function (Blueprint $table) {
            $table->dropColumn('data');
        });
    }
};
