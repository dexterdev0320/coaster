<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coasters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('pmc_id');
            $table->string('name');
            $table->string('dept');
            $table->string('location');
            $table->string('seat_no');
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
        Schema::dropIfExists('coasters');
    }
}
