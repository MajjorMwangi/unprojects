<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToProjectsTable extends Migration
{
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->unsignedBigInteger('fund_id')->nullable();
            $table->foreign('fund_id', 'fund_fk_6988510')->references('id')->on('funds');
            $table->unsignedBigInteger('lead_organisation_unit_id')->nullable();
            $table->foreign('lead_organisation_unit_id', 'lead_organisation_unit_fk_6988515')->references('id')->on('lead_organisations');
        });
    }
}
