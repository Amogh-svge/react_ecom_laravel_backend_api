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
        Schema::create('product_reviews', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('reviewer_name');
            $table->string('reviewer_photo');
            $table->string('reviewer_rating');
            $table->text('reviewer_comment');
            $table->timestamps();
            $table->string('product_code');
            $table->unsignedBigInteger('reviewer_id')->index('product_reviews_reviewer_id_foreign');
            $table->unsignedBigInteger('product_id')->index('product_reviews_product_id_foreign');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_reviews');
    }
};
