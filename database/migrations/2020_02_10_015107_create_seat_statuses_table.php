<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateSeatStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seat_status', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('seat_no');
            $table->unsignedBigInteger('emp_id')->nullable();
            $table->foreign('emp_id')->references('id')->on('employees');
            $table->string('code')->nullable();
            $table->unsignedBigInteger('dest_id')->nullable();
            $table->foreign('dest_id')->references('id')->on('destinations');
            $table->integer('status')->default('1');
            $table->string('day');
            $table->timestamps();
        });

        $seats = 40;
        for ($i=1; $i <= $seats; $i++) { 
            DB::table('seat_status')->insert(
                array(
                    'seat_no' => $i,
                    'status' => 1,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    'day' => 'Saturday'
                )
            );
        }

        $seats = 40;
        for ($i=1; $i <= $seats; $i++) { 
            DB::table('seat_status')->insert(
                array(
                    'seat_no' => $i,
                    'status' => 1,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    'day' => 'Monday'
                )
            );
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seat_status');
    }
}
