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
        Schema::create('home_details', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->string('title')->nullable();
            $table->string('sub_title')->nullable();
            $table->string('title_color')->nullable();
            $table->string('title_font_size')->nullable();
            $table->string('title_font_family')->nullable();
            $table->string('sub_title_color')->nullable();
            $table->string('sub_title_font_size')->nullable();
            $table->string('sub_title_font_family')->nullable();
            $table->longText('description')->nullable();
            $table->string('description_color')->nullable();
            $table->string('description_font_size')->nullable();
            $table->string('description_font_family')->nullable();
            $table->string('our_story_image')->nullable();
            $table->string('businesses_title')->nullable();
            $table->string('testimonials_title')->nullable();
            $table->string('icon')->nullable();
            $table->string('amount')->nullable();
            $table->string('name')->nullable();
            $table->string('count_amount_color')->nullable();
            $table->string('count_name_color')->nullable();
            $table->string('count_background_color')->nullable();
            $table->string('count_amount_font_size')->nullable();
            $table->string('count_name_font_size')->nullable();
            $table->string('count_amount_font_family')->nullable();
            $table->string('count_name_font_family')->nullable();
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
        Schema::dropIfExists('home_details');
    }
};
