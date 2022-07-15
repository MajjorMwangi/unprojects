<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonorProjectPivotTable extends Migration
{
    public function up()
    {
        Schema::create('donor_project', function (Blueprint $table) {
            $table->unsignedBigInteger('project_id');
            $table->foreign('project_id', 'project_id_fk_6988517')->references('id')->on('projects')->onDelete('cascade');
            $table->unsignedBigInteger('donor_id');
            $table->foreign('donor_id', 'donor_id_fk_6988517')->references('id')->on('donors')->onDelete('cascade');
        });
    }
}
