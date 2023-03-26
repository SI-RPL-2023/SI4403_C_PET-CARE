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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->char('pet_owner_id', 6);
            $table->char('vet_id', 6);
            $table->string('pet_name');
            $table->string('pet_type');
            $table->string('phone')->nullable();
            $table->date('date');
            $table->string('time');
            $table->string('address')->nullable();
            $table->string('payment')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('appointments');
    }
};
