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
        Schema::create('contact_uses', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->string('title_color')->nullable();
            $table->string('title_font_size')->nullable();
            $table->string('title_font_family')->nullable();
            $table->string('sub_title')->nullable();
            $table->string('sub_title_color')->nullable();
            $table->string('sub_title_font_size')->nullable();
            $table->string('sub_title_font_family')->nullable();
            $table->string('form_title')->nullable();
            $table->string('form_title_color')->nullable();
            $table->string('form_title_font_size')->nullable();
            $table->string('form_title_font_family')->nullable();
            $table->string('form_sub_title')->nullable();
            $table->string('form_sub_title_color')->nullable();
            $table->string('form_sub_title_font_size')->nullable();
            $table->string('form_sub_title_font_family')->nullable();
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
        Schema::dropIfExists('contact_uses');
    }
};
