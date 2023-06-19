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
        Schema::create('custom_order', function (Blueprint $table) {
            $table->id();
            $table->string('coffee_qty')->nullable();
            $table->string('milk_qty')->nullable();
            $table->string('soya_qty')->nullable();
            $table->string('classic_qty')->nullable();
            $table->string('brownSugar_qty')->nullable();
            $table->string('whiteSugar_qty')->nullable();
            $table->string('cocoa_qty')->nullable();
            $table->string('creamer_qty')->nullable();
            $table->string('frenchVanilla_qty')->nullable();
            $table->string('hazelnut_qty')->nullable();
            $table->string('butterscotch_qty')->nullable();
            $table->string('caramel_qty')->nullable();
            $table->string('chocolate_qty')->nullable();
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
        Schema::dropIfExists('custom_order');
    }
};
