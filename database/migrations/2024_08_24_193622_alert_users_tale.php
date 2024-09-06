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
        Schema::table('users', function (Blueprint $table) {
            $table->string('address2')->nullable();
            $table->string('empemail')->nullable();
            $table->string('empphone')->nullable();
            $table->string('empaddress')->nullable();

            $table->string('nokfname')->nullable();
            $table->string('noklname')->nullable();
            $table->string('nokphone')->nullable();
            $table->string('nokemail')->nullable();
            $table->string('nokaddress')->nullable();
            $table->string('nokdob')->nullable();
            $table->string('nokgender')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
