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
        Schema::table('category_subcategories', function (Blueprint $table) {
            $table->foreign(['subcategory_id'])->references(['id'])->on('subcategories')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['category_id'])->references(['id'])->on('categories')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('category_subcategories', function (Blueprint $table) {
            $table->dropForeign('category_subcategories_subcategory_id_foreign');
            $table->dropForeign('category_subcategories_category_id_foreign');
        });
    }
};
