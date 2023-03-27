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
        Schema::create('horosco_startsign_data', function (Blueprint $table) {
            $table->id('data_id');
            $table->integer('starsign_id')->nullable();
            $table->date('date_from')->nullable();
            $table->date('date_to')->nullable();
            $table->string('data_type');
            $table->longText('data_txt')->nullable();
            $table->date('data_added_date')->default(\Illuminate\Support\Carbon::now());
            $table->string('data_from_file')->nullable();
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
        Schema::dropIfExists('horosco_startsign_data');
    }
};
