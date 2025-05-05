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
        Schema::create('jobseeker_more_details', function (Blueprint $table) {
            $table->id();
            $table->text('phone');
            $table->text('Country');
            $table->text('region');
            $table->text('district');
            $table->text('street');
            $table->foreignId('jobseeker_id')->constrained('users')->onDelete('cascade');
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
        Schema::dropIfExists('jobseeker_more_details');
    }
};
