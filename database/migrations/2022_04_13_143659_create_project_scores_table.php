<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_scores', function (Blueprint $table) {
            $table->id();
            $table->string('file_name');
            $table->unsignedBigInteger('vendor_project_id');
            $table->unsignedBigInteger('permit_type_id');
            $table->timestamps();

            $table->foreign('vendor_project_id')->references('id')->on('vendor_projects')->onDelete('cascade');
            $table->foreign('permit_type_id')->references('id')->on('permit_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_scores');
    }
}
