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
        Schema::create('product_ingredients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('tag');
            $table->foreignId('products_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreignId('types_id')->references('id')->on('types')->onDelete('cascade');
            $table->foreignId('category_id')->references('id')->on('category')->onDelete('cascade');
            $table->foreignId('measurements_id')->references('id')->on('measurements')->onDelete('cascade');
            $table->string('measurement');
            $table->string('unit');
            $table->decimal('price',5,2);
            $table->string('volume');
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
        Schema::dropIfExists('product_ingredients');
    }
};
