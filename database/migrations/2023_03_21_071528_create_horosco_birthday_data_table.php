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
        Schema::create('horosco_birthday_data', function (Blueprint $table) {
            $table->id('data_id');
            $table->string('birthday_special_note');
            $table->date('bdate')->nullable();
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
        Schema::dropIfExists('horosco_birthday_data');
    }
};
