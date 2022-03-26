<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCameraIpAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('camera_ip_addresses', function (Blueprint $table) {
            $table->id();
            $table->ipAddress('ip');
            $table->integer('camera_type');
            $table->unsignedBigInteger('camera_gate_id');
            $table->timestamps();

            $table->foreign('camera_gate_id')->references('id')->on('camera_gates')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('camera_ip_addresses');
    }
}
