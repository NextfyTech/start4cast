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
        Schema::create('horosco_spl_data', function (Blueprint $table) {
            $table->id('spl_data_id');
            $table->integer('spl_category_id')->nullable();
            $table->date('spl_date_from')->nullable();
            $table->date('spl_date_to')->nullable();
            $table->integer('starsign_id')->nullable();
            $table->integer('archive')->default(0);
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
        Schema::dropIfExists('horosco_spl_data');
    }
};
