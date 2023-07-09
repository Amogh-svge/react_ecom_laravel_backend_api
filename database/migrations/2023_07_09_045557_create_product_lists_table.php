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
        Schema::create('product_lists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('price');
            $table->string('special_price')->nullable();
            $table->string('image');
            $table->string('remark');
            $table->string('brand');
            $table->string('product_code');
            $table->timestamps();
            $table->unsignedBigInteger('category_id')->index('product_lists_category_id_foreign');
            $table->unsignedBigInteger('subcategory_id')->index('product_lists_subcategory_id_foreign');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_lists');
    }
};
