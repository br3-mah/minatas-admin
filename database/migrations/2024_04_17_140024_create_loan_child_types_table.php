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
        Schema::create('loan_child_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name'); // Assuming 'name' is a string column
            $table->string('type_name')->nullable(); // Assuming 'type_name' is a string column
            $table->text('description')->nullable(); // Assuming 'description' is a text column
            $table->unsignedBigInteger('loan_type_id')->nullable(); // Assuming 'loan_type_id' is an unsigned big integer column referencing the 'id' column of the 'loan_types' table
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loan_child_types');
    }
};
