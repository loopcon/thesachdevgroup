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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('brand_id')->unsigned(); 
            $table->foreign('brand_id')->references('id')->on('brands');
            $table->string('image')->nullable();
            $table->string('name')->nullable();
            $table->string('price')->nullable();
            $table->string('link')->nullable();
            $table->string('name_color')->nullable();
            $table->string('price_color')->nullable();
            $table->string('name_font_size')->nullable();
            $table->string('price_font_size')->nullable();
            $table->string('name_font_family')->nullable();
            $table->string('price_font_family')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('cars');
    }
};
