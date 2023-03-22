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
        Schema::create('horosco_starsign_master', function (Blueprint $table) {
            $table->id('starsign_id');
            $table->string('starsign')->nullable();
            $table->string('starsign_date_range')->nullable();
            $table->string('starsign_img');
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
        Schema::dropIfExists('horosco_starsign_master');
    }
};
