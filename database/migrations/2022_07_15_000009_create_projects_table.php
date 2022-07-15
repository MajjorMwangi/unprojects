<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->unique();
            $table->string('paas_code')->unique();
            $table->string('approval_status');
            $table->decimal('pag_value', 15, 2);
            $table->date('start_date');
            $table->date('end_date');
            $table->decimal('total_expenditure', 15, 2);
            $table->decimal('total_contribution', 15, 2);
            $table->decimal('total_psc', 15, 2);
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
