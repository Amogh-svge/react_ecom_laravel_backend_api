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
        Schema::create('cart_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('invoice_no');
            $table->string('product_name');
            $table->string('product_code');
            $table->string('size');
            $table->string('color');
            $table->string('quantity');
            $table->string('unit_price');
            $table->string('total_price');
            $table->string('email');
            $table->string('name');
            $table->string('payment_method');
            $table->text('delivery_address');
            $table->string('city');
            $table->string('delivery_charge');
            $table->string('order_date');
            $table->string('order_time');
            $table->string('order_status');
            $table->timestamps();
            $table->unsignedBigInteger('product_id')->index('cart_orders_product_id_foreign');
            $table->unsignedBigInteger('user_id')->index('cart_orders_user_id_foreign');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart_orders');
    }
};
