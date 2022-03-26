<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorPermitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_permits', function (Blueprint $table) {
            $table->id();
            $table->string('file_name');
            $table->unsignedBigInteger('permit_type_id');
            $table->unsignedBigInteger('vendor_project_id');
            $table->timestamps();

            $table->foreign('permit_type_id')->references('id')->on('permit_types')->onDelete('cascade');
            $table->foreign('vendor_project_id')->references('id')->on('vendor_projects')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vendor_permits');
    }
}
