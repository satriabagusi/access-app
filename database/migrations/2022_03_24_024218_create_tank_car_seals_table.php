<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTankCarSealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tank_car_seals', function (Blueprint $table) {
            $table->id();
            $table->string('plate_number');
            $table->string('driver_name');
            $table->integer('capacity');
            $table->string('top_seal_capture');
            $table->string('side_seal_capture');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('camera_ip_address_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('camera_ip_address_id')->references('id')->on('camera_ip_addresses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tank_car_seals');
    }
}
