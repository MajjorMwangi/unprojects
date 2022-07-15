<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectThemePivotTable extends Migration
{
    public function up()
    {
        Schema::create('project_theme', function (Blueprint $table) {
            $table->unsignedBigInteger('project_id');
            $table->foreign('project_id', 'project_id_fk_6988516')->references('id')->on('projects')->onDelete('cascade');
            $table->unsignedBigInteger('theme_id');
            $table->foreign('theme_id', 'theme_id_fk_6988516')->references('id')->on('themes')->onDelete('cascade');
        });
    }
}
