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
        // Schema::table('loan_types', function (Blueprint $table) {
        //     $table->text('alt_icon')->nullable();
        //     $table->string('card_bg')->nullable();
        // });
        // Schema::table('loan_products', function (Blueprint $table) {
        //     $table->text('alt_icon')->nullable();
        //     $table->string('card_bg')->nullable();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alter_icons');
    }
};
