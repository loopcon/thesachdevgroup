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
        Schema::create('service_testimonial', function (Blueprint $table) {
            $table->id();
            $table->integer('service_center_id')->nullable()->comment('`id` of `service_center`');
            $table->string('name')->nullable();
            $table->string('name_font_size')->nullable();
            $table->string('name_font_family')->nullable();
            $table->string('name_font_color')->nullable();
            $table->string('name_background_color')->nullable();
            $table->longText('description')->nullable();
            $table->string('description_text_size')->nullable();
            $table->string('description_text_color')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_testimonial');
    }
};
