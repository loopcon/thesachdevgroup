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
        Schema::create('service_center', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('name_color')->nullable();
            $table->string('name_font_size')->nullable();
            $table->string('name_font_family')->nullable();
            $table->string('image')->nullable();
            $table->longText('description')->nullable();
            $table->string('description_font_size')->nullable();
            $table->string('description_font_family')->nullable();
            $table->string('description_font_color')->nullable();
            $table->longText('address')->nullable();
            $table->string('address_icon')->nullable();
            $table->string('address_font_size')->nullable();
            $table->string('address_font_family')->nullable();
            $table->string('address_font_color')->nullable();
            $table->string('working_hours')->nullable();
            $table->string('working_hours_icon')->nullable();
            $table->string('working_hours_font_size')->nullable();
            $table->string('working_hours_font_family')->nullable();
            $table->string('working_hours_font_color')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('contact_icon')->nullable();
            $table->string('contact_font_size')->nullable();
            $table->string('contact_font_family')->nullable();
            $table->string('contact_font_color')->nullable();
            $table->string('email')->nullable();
            $table->string('email_icon')->nullable();
            $table->string('email_font_size')->nullable();
            $table->string('email_font_family')->nullable();
            $table->string('email_font_color')->nullable();
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
        Schema::dropIfExists('service_center');
    }
};
