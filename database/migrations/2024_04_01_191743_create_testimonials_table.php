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
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('testimonials_title')->nullable();
            $table->string('testimonials_title_color')->nullable();
            $table->string('testimonials_title_font_size')->nullable();
            $table->string('testimonials_title_font_family')->nullable();
            $table->string('name')->nullable();
            $table->string('image')->nullable();
            $table->string('name_background_color')->nullable();
            $table->string('name_color')->nullable();
            $table->string('name_font_size')->nullable();
            $table->string('name_font_family')->nullable();
            $table->longText('description')->nullable();
            $table->string('description_color')->nullable();
            $table->string('description_font_size')->nullable();
            $table->string('description_font_family')->nullable();
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
        Schema::dropIfExists('testimonials');
    }
};
