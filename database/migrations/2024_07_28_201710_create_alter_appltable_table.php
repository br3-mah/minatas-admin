<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->text('desc')->nullable();
            $table->string('date_paid')->nullable();
            $table->string('note')->nullable();
            $table->string('mou_loan')->nullable();
            $table->string('penalties')->nullable();
            $table->string('related_party')->nullable();
            $table->integer('days_late')->nullable();
        });
        Schema::table('users', function (Blueprint $table) {
            $table->string('employer')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alter_appltable');
    }
};
