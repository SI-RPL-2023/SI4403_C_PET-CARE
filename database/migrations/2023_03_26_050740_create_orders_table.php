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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->char('pet_owner_id', 6);
            $table->foreignId('product_id');
            $table->integer('invoice_no');
            $table->string('phone');
            $table->text('address');
            $table->string('payment');
            $table->integer('quantity');
            $table->float('subtotal');
            $table->float('shipping');
            $table->string('status');
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
        Schema::dropIfExists('orders');
    }
};
