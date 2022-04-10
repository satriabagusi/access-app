<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_projects', function (Blueprint $table) {
            $table->id();
            $table->string('project_name');
            $table->string('contract_number');
            $table->date('contract_start');
            $table->date('contract_end');
            $table->integer('status');
            $table->unsignedBigInteger('vendor_id');
            $table->timestamps();

            $table->foreign('vendor_id')->references('id')->on('vendors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vendor_projects');
    }
}
