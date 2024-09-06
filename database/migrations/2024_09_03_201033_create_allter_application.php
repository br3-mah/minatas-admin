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
            $table->string('source')->nullable();
        });
        Schema::table('users', function (Blueprint $table) {
            $table->string('noknrc')->nullable();
            $table->string('nokoccupation')->nullable();
            $table->string('nokrelation')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('allter_application');
    }
};
